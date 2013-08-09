<?php

// auto-loading
Yii::setPathOfAlias('Slit', dirname(__FILE__));
Yii::import('Slit.*');
Yii::import('vendor.phundament.p3pages.models.*');
Yii::import('vendor.phundament.p3media.models.*');

class Slit extends BaseSlit
{

    public $itemLabel = "SlitSlider";

    const INDEXPAGE = 1;
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

    public function showSlider($pageName = NULL)
    {       
        if ($pageName === NULL) {
            // @var pageID: Get active P3Page->id
            $pageID = Slit::getActivePageId();
        } 
        elseif($pageName === Slit::INDEXPAGE) {
            // @var pageID: is P3Page->id = 1 (site/index.php)
            $pageID = Slit::INDEXPAGE;
        }

        // get Slit models for this P3Page and status
        $criteria = new CDbCriteria();
        $criteria->order = Slit::ORDER_BY;
        $criteria->addSearchCondition('page_name', $pageID);
        $criteria->addSearchCondition('status', Slit::SLIT_ACTIVE);
        $criteria->addSearchCondition('language', Yii::app()->getLanguage());
        
        // findAll with this $creteria
        $thisSlits = Slit::model()->findAll($criteria);
        $thisSlitsDots = $thisSlits;

        // Check if slits are availible for this P3age
        if (sizeof($thisSlits) > 0) {
            
            echo "<div class=\"sl-slider-wrapper\" id=\"slider\">\n";
            echo "   <div class=\"sl-slider\">\n";

            foreach ($thisSlits as $slit) {

                echo "      <div class=\"sl-slide\" data-orientation=\"horizontal\" data-slice1-rotation=\"-25\" data-slice1-scale=\"2\" data-slice2-rotation=\"-25\" data-slice2-scale=\"2\">\n";
                echo "          <div class=\"sl-slide-inner\">\n";

                // if slit type -> image
                if ($slit->type === Slit::IMAGE) {

                    $imgSrc = Yii::app()->controller->createUrl('/p3media/file/image', array('id' => $slit->media_id, 'preset' => Slit::IMAGE_PRESET));

                    echo "              <div class=\"bg-img\">\n";
                    echo "                  <img src=\"{$imgSrc}\" alt=\"\" />";
                    echo "              </div>\n";
                    echo "                    <h2>{$slit->headline}</h2>\n";
                    echo "                    <blockquote>\n";
                    echo "                        <p>{$slit->subline}</p>\n";
                    echo "                        <cite>{$slit->link}</cite></blockquote>\n";
                }
                // if slit type -> html
                elseif ($slit->type === Slit::HTML) {
                    echo "              <div class=\"centerHtml\">\n";
                    echo                    $slit->bodyHtml;
                    echo "              </div>\n";
                }

                echo "          </div>\n";
                echo "      </div>\n";
            }
            if (sizeof($thisSlitsDots) > 1) {
                // put needed dots to navigate, first hast class 'nav-dot-current'
                echo "      <nav class=\"nav-dots\" id=\"nav-dots\">\n";
                echo "          <span class=\"nav-dot-current\"></span>\n";

                for ($i = 0; $i < sizeof($thisSlitsDots) - 1; $i++) {
                    echo "              <span></span>";
                }
                echo "      </nav>";
            }
            echo "   </div>\n";
            echo "</div>\n";
        }
        // return false if no slits on this P3Page
        else {
            return false;
        }
    }

    public function get_label()
    {
        return (string) $this->status;
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
                'ownerColumn' => 'created_by',
            ),
        ));
    }

}
