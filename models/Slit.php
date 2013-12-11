<?php

// auto-loading
Yii::setPathOfAlias('Slit', dirname(__FILE__));
Yii::import('Slit.*');
Yii::import('vendor.phundament.p3media.models.*');

class Slit extends BaseSlit
{

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }

    public function relations()
    {
        return array_merge(
            parent::relations()
        );
    }

    public function get_label()
    {
        return (string)$this->status;
    }

    public function scopes()
    {
        return array(
            /**
             * Scope localized only selects data from current language
             */
            'getLocalized' => array(
                'condition' => "language='" . Yii::app()->language . "'",
            ),
        );
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(), array(
                'CTimestampBehavior' => array(
                    'class'           => 'zii.behaviors.CTimestampBehavior',
                    'createAttribute' => 'created_at',
                    'updateAttribute' => 'updated_at',
                ),
                'OwnerBehavior'      => array(
                    'class'       => 'OwnerBehavior',
                    'ownerColumn' => 'created_by',
                ),
            )
        );
    }

    /**
     * TODO... find a way
     * @param type $url
     * @return type tag a link
     */
    public function createLink($url)
    {
        if (strpos($url, 'http') === 0) {
            $link = CHtml::link($url, $url, array('class' => 'pull-left'));
        } else {
            $link = CHtml::link($url, '/' . Yii::app()->getLanguage() . '/' . $url, array('class' => 'pull-left'));
        }
        return $link;
    }

    public function rules()
    {
        return array_merge(
            parent::rules()
        );
    }

    public function getItemLabel()
    {
        return $this->headline;
    }

}
