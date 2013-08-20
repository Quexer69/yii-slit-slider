<?php

/**
 * Class File
 * @author    Christopher Stebe <chris@stebe.eu>
 * @link      https://github.com/Quexer69/yii-slit-slider
 * @copyright Copyright &copy; 2013 Christopher Stebe
 *
 *  Call this Widget on which page and position
 *  you what the slit-slider appear.
 *  With group ID's you can manage multiple sliders in your web application
 * 
 * <pre>
 * <?php
 *   $this->widget(
 *      'vendor.quexer69.yii-slit-slider.SlitSliderWidget', 
 *          array(
 *              'orientation'   => 'horizontal',
 *              'imagePreset'   => 'slitslider',
 *              'order'         => 'rank DESC',
 *              'groupId'       => NULL,
 *              'width'         => '100%',
 *              'height'        => '500px',
 *          )
 *   );
 * ?>
 * </pre>
 * {@link SlitController}
 * @author  Christopher Stebe <chris@stebe.eu>
 * @version 0.2.2
 * @package quexer69/yii-slit-slider
 */

Yii::import('vendor.quexer69.yii-slit-slider.models.*');



class SlitSliderWidget extends CWidget
{
    const widgetName            = 'slitSlider';
    const SLIT_ACTIVE           = 'published';
    const imagePreset_view      = 'medium-picture-original';
    const IMAGE                 = 'image';
    const HTML                  = 'html';

    /**
     * @var slider animation 
     */
    public $orientation = 'horizontal';

    /**
     * @var P3Media image preset 
     */
    public $imagePreset = 'original';

    /**
     * @var sort order 
     */
    public $order = 'rank ASC';

    /**
     * @var groupId to specify a slider group  
     * @type varchar(60) so you can assign numbers or words
     */
    public $groupId = NULL;

    /**
     * @var default width 
     */
    public $width = '100%';

    /**
     * @var default height 
     */
    public $height = '500px';

    
    
    /**
     * run slit slider widget
     */
    public function run()
    {
        // get Slit models for this P3Page and status
        $thisSlits = self::querySlits();

        // Check if slits are availible for this P3age
        if (self::hasSlits($thisSlits)) {

            // Just if there are slits for this P3Page, publish Assets (css, js)
            self::registerAssets();

            // Output HTML Template (for IMAGE and HTML slits)
            self::openSliderWrapper();

            foreach ($thisSlits as $slit) {

                // if slit type -> image
                if ($slit->type === self::IMAGE) {
                    self::showImage($slit);
                }
                // if slit type -> html
                elseif ($slit->type === self::HTML) {
                    self::showHtml($slit);
                }
            }
            // put needed dots to navigate, first has class 'nav-dot-current'
            self::showDots($thisSlits);

            self::closeSliderWrapper();
        }
    }

    /**
     * 
     * @return type array
     */
    public function getP3MediaPreset()
    {
        $p3mediaPreset = array();
        $mediaModule = Yii::app()->getModules();
        foreach ($mediaModule['p3media']['params']['presets'] AS $key => $presets) {

            $name = (isset($presets['name'])) ? " {$presets['name']}" : $key;
            $size = (isset($presets['commands']['resize'][0])) ? "|| {$presets['commands']['resize'][0]}x{$presets['commands']['resize'][1]}" : '';
            $modus = (isset($presets['commands']['resize'][2])) ? " || Modus {$presets['commands']['resize'][2]}" : '';
            $title = "{$name} {$size} {$modus}";
            $p3mediaPreset[$key] = $title;
        }
        return $p3mediaPreset;
    }

    /**
     * 
     * @return array
     */
    public function getP3MediaPresetName($preset)
    {
        $mediaModule = Yii::app()->getModules();
        foreach ($mediaModule['p3media']['params']['presets'] AS $key => $presets) {

            if ($key === $preset) {
                $name = (isset($presets['name'])) ? " {$presets['name']}" : $key;
                $size = (isset($presets['commands']['resize'][0])) ? "{$presets['commands']['resize'][0]}x{$presets['commands']['resize'][1]}" : '';
                $modus = (isset($presets['commands']['resize'][2])) ? " Modus {$presets['commands']['resize'][2]}" : '';
                $title = "<span class=\"badge badge-danger\">{$name}</span> <span class=\"badge badge-danger\">{$size}</span> <span class=\"badge badge-danger\">{$modus}</span>";
                return $title;
            }
        }
        return false;
    }

    /**
     * Register CSS Files and JavaScript
     * Register CSS from width and height param
     */
    public function registerAssets()
    {
        $registerScripts = Yii::app()->getClientScript();

        // Custom CSS wrapper settings
        $cssParam = ".sl-slider-wrapper {width: {$this->width};height: {$this->height};}";
        $registerScripts->registerCss('slitSlider_custom', $cssParam);

        // JS files
        $js = Yii::app()->assetManager->publish(Yii::getPathOfAlias('SlitAssets') . '/js', true, -1, true); // set last param to `true` for development
        $registerScripts->registerScriptFile($js . "/jquery.ba-cond.min.js", CClientScript::POS_END);
        $registerScripts->registerScriptFile($js . "/modernizr.custom.79639.js", CClientScript::POS_END);
        $registerScripts->registerScriptFile($js . "/jquery.slitslider.js", CClientScript::POS_END);
        $registerScripts->registerScriptFile($js . "/jquery.slitslider.init.js", CClientScript::POS_END);

        // CSS files
        $css = Yii::app()->assetManager->publish(Yii::getPathOfAlias('SlitAssets') . '/css', true, -1, true); // set last param to `true` for development
        $registerScripts->registerCssFile($css . '/slitslider.css');
    }

    /**
     * 
     * @param type $groupID
     * @return Slit::model()
     */
    public function querySlits()
    {
        $criteria = new CDbCriteria();
        // TODO prepare fore start_date -> end_date support
        //$now = new CDbExpression("NOW()");
        $criteria->order = $this->order;

        /**
         * check if SliderWidget groupId is set
         * OR NULL because slits without group_id
         * will be shown in all sliders
         */
        if ($this->groupId !== NULL && !empty($this->groupId)) {
            $criteria->addCondition('group_id   = \'' . $this->groupId . '\' OR group_id IS NULL');
        }
        // checl if slit is an active slit (published)
        $criteria->addCondition('status     = \'' . $this::SLIT_ACTIVE . '\'');
        
        // check if slit is for current language
        $criteria->addCondition('language   = \'' . Yii::app()->getLanguage() . '\'');

        // findAll with this $creteria
        return Slit::model()->findAll($criteria);
    }

    /**
     * 
     * @param type $allSlits
     * @return boolean
     */
    public function hasSlits($allSlits)
    {
        if (sizeof($allSlits) > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @param type $allSlits
     * @return boolean
     */
    public function hasDots($allSlits)
    {
        if (sizeof($allSlits) > 1) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @return string
     */
    public static function getImageModeInfo()
    {
        // Master Dimension
        $modes = "1 = NONE | 2 = AUTO | 3 = HEIGHT | 4 = WIDTH | 7 = AUTO_FIT | 5 = HORIZONTAL | 6 = VERTICAL";
        return $modes;
    }

    /**
     * 
     * @param type $model
     */
    public function showImage($model)
    {
        // Create image URL, check if media_preset for image is in config/main availible
        $imgSrc = Yii::app()->controller->createUrl('/p3media/file/image', array(
            'id' => $model->media_id,
            'preset' => (isset($model->image_preset)) ? $model->image_preset : $this->imagePreset));

        $thisDataOrientation = (isset($model->data_orientation)) ? $model->data_orientation : $this->orientation;

        echo "      <div class=\"sl-slide\" 
                            data-orientation=\"$thisDataOrientation\" 
                            data-slice1-rotation=\"$model->data_slice1_rotation\" 
                            data-slice2-rotation=\"$model->data_slice2_rotation\" 
                            data-slice1-scale=\"$model->data_slice1_scale\" 
                            data-slice2-scale=\"$model->data_slice2_scale\">\n";

        echo "          <div class=\"sl-slide-inner\">\n";
        echo "              <div class=\"bg-img centerHtml\">\n";
        echo "                  <img src=\"{$imgSrc}\" alt=\"\" />";
        echo "              </div>\n";
        echo "                    <h2>{$model->headline}</h2>\n";
        echo "                    <blockquote>\n";
        echo "                        <p>{$model->subline}</p>\n";
        if ($model->link !== NULL) {
            echo "<a class=\"btn btn-theme\" href=\"{$model->link}\" target=\"_blank\"><i class=\"icon-external-link\"></i>mehr</a>";
        }
        echo "</blockquote>\n";
        echo "          </div>\n";
        echo "      </div>\n";
    }

    /**
     * 
     * @param type $model
     */
    public function showHtml($model)
    {
        echo "      <div class=\"sl-slide\" 
                            data_orientation=\"$model->data_orientation\" 
                            data_slice1_rotation=\"$model->data_slice1_rotation\" 
                            data_slice2_rotation=\"$model->data_slice2_rotation\" 
                            data_slice1_scale=\"$model->data_slice1_scale\" 
                            data_slice2_scale=\"$model->data_slice2_scale\">\n";

        echo "          <div class=\"sl-slide-inner\">\n";
        echo "              <div class=\"centerHtml\">\n";
        echo $model->bodyHtml;
        echo "              </div>\n";
        echo "          </div>\n";
        echo "      </div>\n";
    }

    /**
     * 
     * @param type $allSlits
     */
    public function showDots($allSlits)
    {
        if ($this->hasDots($allSlits)) {
            $_size = sizeof($allSlits);

            if ($_size > 1) {

                echo "      <nav class=\"nav-dots\" id=\"nav-dots\">\n";
                echo "          <span class=\"nav-dot-current\"></span>\n";

                for ($i = 0; $i < $_size - 1; $i++) {
                    echo "              <span></span>";
                }
                echo "      </nav>";
            }
        }
    }

    public function openSliderWrapper()
    {
        echo "<div class=\"sl-slider-wrapper\" id=\"slider\">\n";
        echo "   <div class=\"sl-slider\">\n";
    }

    public function closeSliderWrapper()
    {
        echo "   </div>\n";
        echo "</div>\n";
    }

}

?>