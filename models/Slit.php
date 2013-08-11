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

}