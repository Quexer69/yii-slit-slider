<?php

/**
 * Class File
 * @author    Christopher Stebe <chris@stebe.eu>
 * @link      https://github.com/Quexer69
 * @copyright Copyright &copy; 2005-2010 diemeisterei GmbH
 * @license   http://www.phundament.com/license/
 *
 *  Call this Widget on which page and position
 *  you what the slit-slider appear
 * 
 * <pre>
 * <?php
 *   $this->widget(
 *      'vendor.quexer69.yii-slit-slider.SlitSliderWidget', 
 *          array(
 *              'orientation'   => 'horizontal',
 *              'image_preset'  => 'slitslider',
 *              'order'         => 'rank DESC',
 *              'pageId'        => null,
 *              'width'         => '100%',
 *              'height'        => '600px',
 *          )
 *   );
 * ?>
 * </pre>
 * {@link SlitController}
 * @author  Christopher Stebe <chris@stebe.eu>
 * @version 0.1.0
 * @package quexer69/yii-slit-slider
 */
class SlitSliderWidget extends CWidget
{

    const SLIT_ACTIVE       = 'published';
    const IMAGE             = 'image';
    const HTML              = 'html';
    
    // Public params for JSON Editor
    public $orientation     = 'horizontal';
    public $image_preset    = 'original';
    public $order           = 'rank ASC';
    public $pageId          = null;
    public $width           = '100%';
    public $height          = '600px';

    public function run()
    {
        // @var pageID: Get active P3Page->id
        $pageID = self::getActivePageId();

        // get Slit models for this P3Page and status
        $thisSlits = self::querySlits($pageID);

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
        foreach (Yii::app()->getModules()['p3media']['params']['presets'] AS $key => $presets) {

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
        foreach (Yii::app()->getModules()['p3media']['params']['presets'] AS $key => $presets) {

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
    
    public function getP3MediaPresetNames()
    {
        $p3mediaPreset = array();
        foreach (Yii::app()->getModules()['p3media']['params']['presets'] AS $key => $presets) {
            array_push($p3mediaPreset, $key);
        }
        return $p3mediaPreset;
    }

    /**
     * 
     * @return array with all P3Pages
     * Index: [P3Page->id]
     * Value: [P3Page->nameId]
     */
    public function getP3Pages()
    {
        $nameIds = array();

        //FindAll P3Page's
        $p3pages = P3Page::model()->findAll();
        foreach ($p3pages AS $p3page) {

            // If page has nameId
            if ($p3page->nameId)
                $nameIds[$p3page->id] = "ID: " . $p3page->id . " || " .$p3page->nameId;
        }
        return $nameIds;
    }

    /**
     * 
     * @return array
     * Index: [P3Page->id]
     * Value: [P3Page->nameId]
     */
    public function getActivePage()
    {
        if (!P3Page::getActivePage()) {
            return false;
        } else {
            return array(P3Page::getActivePage()->id => P3Page::getActivePage()->nameId);
        }
    }

    /**
     * 
     * @return int : P3Page->id
     */
    public function getActivePageId()
    {
        if (isset($this->pageId) && $this->pageId !== NULL && !empty($this->pageId)) {
            return $this->pageId;
        } else {
            $activePage = $this->getActivePage();
            foreach ($activePage as $key => $nameId) {

                return $key;
            }
        }
    }

    /**
     * 
     * @return string : P3Page->nameId
     */
    public function getActivePageNameId()
    {
        $activePage = $this->getActivePage();
        foreach ($activePage as $key => $nameId) {

            return $nameId;
        }
    }

    /**
     * Register CSS Files and JavaScript
     * Register CSS from width and height param
     */
    private function registerAssets()
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
     * @param type $pageID
     * @return type
     */
    public function querySlits($pageID)
    {
        $criteria = new CDbCriteria();
        $now = new CDbExpression("NOW()");
        $criteria->order = $this->order;

//        $criteria->addCondition('start_date > ' . $now);
//        $criteria->addCondition($now . ' < end_date');

        $criteria->addSearchCondition('page_id', $pageID);
        $criteria->addSearchCondition('status', $this::SLIT_ACTIVE);
        $criteria->addSearchCondition('language', Yii::app()->getLanguage());

        // findAll with this $creteria
        return Slit::model()->findAll($criteria);
    }

    /**
     * 
     * @param type $allSlits
     * @return boolean
     */
    private function hasSlits($allSlits)
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
    private function hasDots($allSlits)
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
    public function getImageModeInfo()
    {
        // Master Dimension
        $modes = "1 = NONE | 2 = AUTO | 3 = HEIGHT | 4 = WIDTH | 7 = AUTO_FIT | 5 = HORIZONTAL | 6 = VERTICAL | ";
        return $modes;
    }

    /**
     * 
     * @param type $model
     */
    private function showImage($model)
    {
        // Create image URL, check if media_preset for image is in config/main availible
        $imgSrc = Yii::app()->controller->createUrl('/p3media/file/image', array(
            'id' => $model->media_id,
            'preset' => (isset($model->image_preset) && in_array($model->image_preset, self::getP3MediaPresetNames())) ? $model->image_preset : $this->image_preset));

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
        echo "                        <cite>{$model->link}</cite></blockquote>\n";
        echo "          </div>\n";
        echo "      </div>\n";
    }

    /**
     * 
     * @param type $model
     */
    private function showHtml($model)
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
    private function showDots($allSlits)
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

    private static function openSliderWrapper()
    {
        echo "<div class=\"sl-slider-wrapper\" id=\"slider\">\n";
        echo "   <div class=\"sl-slider\">\n";
    }

    private static function closeSliderWrapper()
    {
        echo "   </div>\n";
        echo "</div>\n";
    }

}

?>