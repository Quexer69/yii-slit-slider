<?php

// auto-loading
Yii::setPathOfAlias('Slit', dirname(__FILE__));
Yii::import('Slit.*');

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

    /**
     * 
     * @param type $media_id
     * @param type $link
     * @param type $title
     * @param type $preset
     * @return type
     */
    public function createImageLink($media_id, $title, $link = array(), $preset = null)
    {
        $createUrl = Yii::app()->controller->createUrl('/p3media/file/image', array('id' => $media_id, 'preset' => $preset));
        $image = CHtml::image($createUrl, $title, array('class' => 'pull-left'));
        $link = CHtml::link($image, is_array($link) ? $link : '', array('class' => 'pull-left btn-info'));
        return $link;
    }

    /**
     * 
     * @param type $user_id
     */
    public function getFullUserId($user_id)
    {
        $thisUser = Profile::model()->findByPk($user_id);
        return "{$thisUser->first_name} {$thisUser->last_name} | ID:{$thisUser->user_id}";
    }

    public function rules()
    {
        return array_merge(
                parent::rules()
                /* , array(
                  array('column1, column2', 'rule1'),
                  array('column3', 'rule2'),
                  ) */
        );
    }

}
