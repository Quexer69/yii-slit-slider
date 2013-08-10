<?php

// auto-loading
Yii::setPathOfAlias('SlitAassets', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR));
Yii::setPathOfAlias('Slit', dirname(__FILE__));
Yii::import('Slit.*');

class Slit extends BaseSlit
{

    public $itemLabel = "SlitSlider";

    const SLIT_ACTIVE = 'published';
    const IMAGE = 'image';
    const HTML = 'html';
    const IMAGE_PRESET = 'xlarge';
    const ORDER_BY = 'rank';

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }

    public function behaviors()
    {
        return array_merge(
                parent::behaviors(), array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
                'updateAttribute' => 'updated_at',
            ),
            'OwnerBehavior' => array(
                'class' => 'OwnerBehavior',
                'ownerColumn' => 'created_by'
            ),
        ));
    }

    /*
     *  Call this function on which page and position
     *  you what the slit-slider appear
     * 
     *      <?php Slit::showSlider(); ?>
     */
    public function showSlider()
    {
        // @var pageID: Get active P3Page->id
        $pageID = Slit::getActivePageId();

        // get Slit models for this P3Page and status
        $thisPage = Slit::querySlits($pageID);

        // Check if slits are availible for this P3age
        if (Slit::hasSlits($thisPage)) {

            // Just if the SlitSlider would be shown, publish Assls (css, js)
            Slit::registerAssets();

            // Output HTML Template, id -> slider
            Slit::openSliderWrapper();

            foreach ($thisPage as $slit) {

                // if slit type -> image
                if ($slit->type === Slit::IMAGE) {

                    Slit::showImage($slit->media_id, Slit::IMAGE_PRESET, $slit->headline, $slit->subline, $slit->link, $slit->custom_attributes);
                }
                // if slit type -> html
                elseif ($slit->type === Slit::HTML) {

                    Slit::showHtml($slit->bodyHtml, $slit->custom_attributes);
                }
            }
            // put needed dots to navigate, first hast class 'nav-dot-current'
            Slit::showDots($thisPage);

            Slit::closeSliderWrapper();
        }
    }

    public function getP3MediaNames()
    {
        // TODO: checkAccess for media Files!!
        return P3Media::model()->findAll();
    }

    public function getP3Pages()
    {
        $nameIds = array();

        //FindAll P3Page's
        $p3pages = P3Page::model()->findAll();
        foreach ($p3pages AS $p3page) {

            // If page hast nameId
            if ($p3page->nameId)
                $nameIds[$p3page->id] = $p3page->nameId;
        }
        return $nameIds;
    }

    public function getActivePage()
    {
        if (!P3Page::getActivePage()) {
            return array("1" => "index");
        }

        if (P3Page::getActivePage()->nameId) {
            return array(P3Page::getActivePage()->id => P3Page::getActivePage()->nameId);
        } elseif (P3Page::getActivePage()->parent && P3Page::getActivePage()->parent->nameId) {
            return array(P3Page::getActivePage()->parent->id => P3Page::getActivePage()->parent->nameId);
        } elseif (P3Page::getActivePage()->parent->parent && P3Page::getActivePage()->parent->parent->nameId) {
            return array(P3Page::getActivePage()->parent->parent->id => P3Page::getActivePage()->parent->parent->nameId);
        }
    }

    public function getActivePageId()
    {
        $activePage = Slit::getActivePage();
        foreach ($activePage as $key => $nameId) {

            return $key;
        }
    }

    public function getActivePageNameId()
    {
        $activePage = Slit::getActivePage();
        foreach ($activePage as $key => $nameId) {

            return $nameId;
        }
    }

    public function registerAssets()
    {
        $registerScripts = Yii::app()->getClientScript();

        // JS files
        $js = Yii::app()->assetManager->publish(Yii::getPathOfAlias('SlitAassets') . '/js', true, -1, true); // set last param to `true` for development
        $registerScripts->registerScriptFile($js . "/jquery.slitslider.js", CClientScript::POS_END);
        $registerScripts->registerScriptFile($js . "/jquery.slitslider.init.js", CClientScript::POS_END);

        // CSS files
        $css = Yii::app()->assetManager->publish(Yii::getPathOfAlias('SlitAassets') . '/css', true, -1, true); // set last param to `true` for development
        $registerScripts->registerCssFile($css . '/slitslider.css');
    }

    public function querySlits($pageID)
    {
        $criteria = new CDbCriteria();
        $criteria->order = Slit::ORDER_BY;
        $criteria->addSearchCondition('page_name', $pageID);
        $criteria->addSearchCondition('status', Slit::SLIT_ACTIVE);
        $criteria->addSearchCondition('language', Yii::app()->getLanguage());

        // findAll with this $creteria
        return Slit::model()->findAll($criteria);
    }

    public function hasSlits($allSlits)
    {
        if (sizeof($allSlits) > 0) {
            return true;
        }
        return false;
    }

    public function hasDots($allSlits)
    {
        if (sizeof($allSlits) > 1) {
            return true;
        }
        return false;
    }

    public function showImage($id, $preset, $headline, $subline, $link, $custom_attributes)
    {
        $imgSrc = Yii::app()->controller->createUrl('/p3media/file/image', array('id' => $id, 'preset' => $preset));

        echo "      <div class=\"sl-slide\" {$custom_attributes}>\n";
        echo "          <div class=\"sl-slide-inner\">\n";
        echo "              <div class=\"bg-img\">\n";
        echo "                  <img src=\"{$imgSrc}\" alt=\"\" />";
        echo "              </div>\n";
        echo "                    <h2>{$headline}</h2>\n";
        echo "                    <blockquote>\n";
        echo "                        <p>{$subline}</p>\n";
        echo "                        <cite>{$link}</cite></blockquote>\n";
        echo "          </div>\n";
        echo "      </div>\n";
    }

    public function showHtml($code, $custom_attributes)
    {
        echo "      <div class=\"sl-slide\" {$custom_attributes}>\n";
        echo "          <div class=\"sl-slide-inner\">\n";
        echo "              <div class=\"centerHtml\">\n";
        echo $code;
        echo "              </div>\n";
        echo "          </div>\n";
        echo "      </div>\n";
    }

    public function showDots($allSlits)
    {
        if (Slit::hasDots($allSlits)) {
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