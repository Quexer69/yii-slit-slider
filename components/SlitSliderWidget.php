<?php

/**
 * Class File
 * @author      Christopher Stebe <cstebe@iserv4u.com>
 * @link        https://github.com/Quexer69/yii-slit-slider
 * @copyright   Copyright &copy; 2013 iServ4u GbR
 * @link        DefaultController
 * @package     quexer69/yii-slit-slider
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
 *              'orientation'   => 'horizontal',    // default orientation if slit has no orientation set
 *              'imagePreset'   => 'slitslider',    // P3Media image preset for pictures
 *              'order'         => 'rank DESC',     // sort order of the slits
 *              'scaleable'     => '1',             // responsive or defined height and width
 *              'groupId'       => NULL,            // show all slits for a group_id
 *              'max_width'     => '2000px',        // needed for scalabel = 1 (true)
 *              'width'         => '100%',          // css width of the wrapper
 *              'height'        => '500px',         // can be set on scalabel = 0 (false)
 *          )
 *   );
 *
 *  Just play around with the properties for your perfect setup of your Slider's !
 * ?>
 * </pre>
 */

Yii::import('slitSlider.models.*');

class SlitSliderWidget extends CWidget
{
    const WIDGET_NAME               = 'slitSlider';
    const SLIT_ACTIVE               = 'published';
    const IMAGE_PRESET_VIEW         = 'small-picture-crop-16-9';
    const IMAGE_PRESET_ADMIN        = 'p3media-upload';
    const IMAGE                     = 'image';
    const HTML                      = 'html';

    /**
     * @var slider animation
     */
    public $orientation = 'horizontal';

    /**
     * @var P3Media image preset
     */
    public $imagePreset = 'p3media-ckbrowse';

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
     * @var slider height behavior (responsive)
     * [ 1 = full | 0 = none ]
     */
    public $scaleable = 1;

    /**
     * @var slider height / weight
     * if responsive = false
     */
    public $width       = '100%';
    public $max_width   = '2000px';
    public $height      = '700px';


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

                switch ($slit->type) {
                    case self::IMAGE:   $this->showImage($slit); break;
                    case self::HTML:    $this->showHtml($slit); break;
                    default: break;
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
    static public function getP3MediaPreset()
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
    static public function getP3MediaPresetName($preset)
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
        // JS files
        $js = Yii::app()->assetManager->publish(Yii::getPathOfAlias('SlitAssets') . '/js', false, -1, false); // set last param to `true` for development
        $registerScripts->registerScriptFile($js . "/jquery.ba-cond.min.js", CClientScript::POS_END);
        $registerScripts->registerScriptFile($js . "/modernizr.custom.79639.js", CClientScript::POS_END);
        $registerScripts->registerScriptFile($js . "/jquery.slitslider.js", CClientScript::POS_END);
        $registerScripts->registerScriptFile($js . "/jquery.slitslider.init.js", CClientScript::POS_END);

        // CSS files
        $css = Yii::app()->assetManager->publish(Yii::getPathOfAlias('SlitAssets') . '/css', false, -1, false); // set last param to `true` for development
        $registerScripts->registerCssFile($css . '/slitslider.css');

        switch ($this->scaleable)
        {
            case 1 :
                $registerScripts->registerCssFile($css . '/responsive.css');
                $cssParam = ".sl-slider-wrapper {max-width: {$this->max_width};}";
                $registerScripts->registerCss('slitSlider_'.$this->max_width.'x'.$this->height, $cssParam);
                break;
            case 0 :
                $cssParam = ".sl-slider-wrapper {width: {$this->width};height: {$this->height} !important;}";
                $registerScripts->registerCss('slitSlider_'.$this->width.'x'.$this->height, $cssParam);
                break;
        }
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
        // check if slit is an active slit (published)
        $criteria->addCondition('status     = \'' . self::SLIT_ACTIVE . '\'');

        // check if slit is for current language
        $criteria->addCondition('language   = \'' . Yii::app()->getLanguage() . '\'');

        // findAll slits with this $creteria
        return Slit::model()->findAll($criteria);
    }

    /**
     *
     * @param type $allSlits
     * @return boolean
     */
    public function hasSlits($allSlits)
    {
        // Check if SlitSlider Group ID has any asigned slit
        return (sizeof($allSlits) > 0) ? true : false;
    }

    /**
     *
     * @param type $allSlits
     * @return boolean
     */
    public function hasDots($allSlits)
    {
        // Check if SlitSlider Group ID has more then 1 asigned slit
        // Show or hide the dots bar
        return (sizeof($allSlits) > 1) ? true : false;
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
        echo "          <img src=\"{$imgSrc}\" alt=\"\" />\n";
        echo "              <div class=\"sl-overlay\">\n";
        echo "                  <div class=\"sl-overlay-inner\">\n";
        echo "                      <h2><strong>{$model->headline}</strong></h2>\n";
        echo "                      <div class=\"subline\">{$model->subline}<br />\n";
        echo "                          <div class=\"sl-link\">\n";
                                        if ($model->link !== NULL) {
                                            if (strpos($model->link,'http') === 0) {
                                                echo CHtml::link("<i class=\"icon-external-link\"></i> mehr", $model->link , array('target' => '_blank', 'class' => 'btn btn-theme pull-left'));
                                            } else {
                                                echo CHtml::link("<i class=\"icon-share\"></i> mehr", '/' . Yii::app()->getLanguage() . '/' . $model->link , array('target' => '_self', 'class' => 'btn btn-theme pull-left'));
                                            }
                                        }
        echo "                          </div>\n";
        echo "                      </div>\n";
        echo "                  </div>\n";
        echo "              </div>\n";
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
        echo $model->body_html;
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
        if ($this->scaleable == 1) {
            echo "<div class=\"aspect-wrapper\">\n";
            echo "  <div class=\"aspect-wrapper-inner\">\n";
        }
            echo "      <div class=\"sl-slider-wrapper\" id=\"slider\">\n";
            echo "          <div class=\"sl-slider\">\n";
    }

    public function closeSliderWrapper()
    {
            echo "          </div>\n";
            echo "      </div>\n";
        if ($this->scaleable == 1) {
            echo "   </div>\n";
            echo "</div>\n";
        }
    }
}
?>
