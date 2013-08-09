<?php

// auto-loading
Yii::setPathOfAlias('Slit', dirname(__FILE__));
Yii::import('Slit.*');

class Slit extends BaseSlit
{

    public $itemLabel = "SlitSlider";

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
        // Get all Slits for current P3Page->nameId
        $pageID = Slit::getActivePageId();
        $thisSlits = Slit::model()->findAllByAttributes(array('page_name' => $pageID));

        if ($pageName === NULL) {

            // get P3page->nameId of the actual page

            echo "<div class=\"sl-slider-wrapper\" id=\"slider\">\n";
            echo "   <div class=\"sl-slider\">\n";

            foreach ($thisSlits as $slit) {

                echo "      <div class=\"sl-slide\" data-orientation=\"horizontal\" data-slice1-rotation=\"-25\" data-slice1-scale=\"2\" data-slice2-rotation=\"-25\" data-slice2-scale=\"2\">\n";
                echo "          <div class=\"sl-slide-inner\">\n";
                echo "              <div class=\"bg-img bg-img-1\"></div>\n";
                echo "                    <h2>{$slit->headline}</h2>\n";
                echo "                    <blockquote>\n";
                echo "                        <p>{$slit->subline}</p>\n";
                echo "                        <cite>{$slit->link}</cite></blockquote>\n";
                echo "          </div>\n";
                echo "      </div>\n";
            }
            echo "      <nav class=\"nav-dots\" id=\"nav-dots\">\n";
            echo "          <span class=\"nav-dot-current\"></span> <span></span> \n";
            echo "      </nav>";


            echo "   </div>\n";
            echo "</div>\n";
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
