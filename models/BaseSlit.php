<?php

/**
 * This is the model base class for the table "slider_slit".
 *
 * Columns in table "slider_slit" available as properties of the model:
 * @property integer $id
 * @property string $status
 * @property string $language
 * @property string $type
 * @property string $headline
 * @property string $subline
 * @property string $link
 * @property string $bodyHtml
 * @property string $keywords
 * @property integer $media_id
 * @property string $group_id
 * @property integer $rank
 * @property string $data_orientation
 * @property string $data_slice1_rotation
 * @property string $data_slice2_rotation
 * @property string $data_slice1_scale
 * @property string $data_slice2_scale
 * @property string $start_date
 * @property string $end_date
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * There are no model relations.
 */
abstract class BaseSlit extends CActiveRecord{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'slider_slit';
	}

	public function rules()
	{
            // TODO: Validation
		return array_merge(
		    parent::rules(), array(
			array('status, language, type, rank', 'required'),
			array('headline, subline, link, bodyHtml, keywords, media_id, group_id, data_orientation, data_slice1_rotation, data_slice2_rotation, data_slice1_scale, data_slice2_scale, start_date, end_date, created_at, updated_at, image_preset', 'default', 'setOnEmpty' => true, 'value' => null),
			array('media_id, rank, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>9),
			array('language', 'length', 'max'=>8),
			array('type, data_slice1_rotation, data_slice2_rotation, data_slice1_scale, data_slice2_scale', 'length', 'max'=>5),
			array('headline, subline, link, keywords, group_id, image_preset', 'length', 'max'=>255),
			array('data_orientation', 'length', 'max'=>10),
			array('bodyHtml, start_date, end_date, created_at, updated_at', 'safe'),
			array('id, status, language, type, headline, subline, link, bodyHtml, keywords, media_id, group_id, rank, data_orientation, data_slice1_rotation, data_slice2_rotation, data_slice1_scale, data_slice2_scale, start_date, end_date, created_at, created_by, updated_at, updated_by', 'safe', 'on'=>'search'),
		    )
		);
	}

	public function behaviors()
	{
		return array_merge(
		    parent::behaviors(), array(
			'savedRelated' => array(
				'class' => 'gii-template-collection.components.CSaveRelationsBehavior'
			)
		    )
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('SlitSliderModule.crud', 'ID'),
			'status' => Yii::t('SlitSliderModule.crud', 'Status'),
			'language' => Yii::t('SlitSliderModule.crud', 'Language'),
			'type' => Yii::t('SlitSliderModule.crud', 'Type'),
			'headline' => Yii::t('SlitSliderModule.crud', 'Headline'),
			'subline' => Yii::t('SlitSliderModule.crud', 'Subline'),
			'link' => Yii::t('SlitSliderModule.crud', 'Link'),
			'bodyHtml' => Yii::t('SlitSliderModule.crud', 'Body Html'),
			'keywords' => Yii::t('SlitSliderModule.crud', 'Keywords'),
			'media_id' => Yii::t('SlitSliderModule.crud', 'P3Media'),
                        'image_preset' => Yii::t('SlitSliderModule.crud', 'Image Preset'),
			'group_id' => Yii::t('SlitSliderModule.crud', 'Slider group'),
			'rank' => Yii::t('SlitSliderModule.crud', 'Position'),
			'data_orientation' => Yii::t('SlitSliderModule.crud', 'Orientation'),
			'data_slice1_rotation' => Yii::t('SlitSliderModule.crud', 'Up | Rotation'),
			'data_slice2_rotation' => Yii::t('SlitSliderModule.crud', 'Down | Rotation'),
			'data_slice1_scale' => Yii::t('SlitSliderModule.crud', 'Up | Scale'),
			'data_slice2_scale' => Yii::t('SlitSliderModule.crud', 'Down | Scale'),
			'start_date' => Yii::t('SlitSliderModule.crud', 'Start Date'),
			'end_date' => Yii::t('SlitSliderModule.crud', 'End Date'),
			'created_at' => Yii::t('SlitSliderModule.crud', 'Created At'),
			'created_by' => Yii::t('SlitSliderModule.crud', 'Created By'),
			'updated_at' => Yii::t('SlitSliderModule.crud', 'Updated At'),
			'updated_by' => Yii::t('SlitSliderModule.crud', 'Updated By'),
		);
	}


	public function search($criteria = null)
	{
        if (is_null($criteria)) {
    		$criteria=new CDbCriteria;
        }
                // TODO: validate not only language, distri check
                $criteria->addSearchCondition('language', Yii::app()->getLanguage());
                
		$criteria->compare('t.id', $this->id);
		$criteria->compare('t.status', $this->status, true);
		$criteria->compare('t.language', $this->language, true);
		$criteria->compare('t.type', $this->type, true);
		$criteria->compare('t.headline', $this->headline, true);
		$criteria->compare('t.subline', $this->subline, true);
		$criteria->compare('t.link', $this->link, true);
		$criteria->compare('t.bodyHtml', $this->bodyHtml, true);
		$criteria->compare('t.keywords', $this->keywords, true);
		$criteria->compare('t.media_id', $this->media_id);
                $criteria->compare('t.image_preset', $this->image_preset);
		$criteria->compare('t.group_id', $this->group_id, true);
		$criteria->compare('t.rank', $this->rank);
		$criteria->compare('t.data_orientation', $this->data_orientation, true);
		$criteria->compare('t.data_slice1_rotation', $this->data_slice1_rotation, true);
		$criteria->compare('t.data_slice2_rotation', $this->data_slice2_rotation, true);
		$criteria->compare('t.data_slice1_scale', $this->data_slice1_scale, true);
		$criteria->compare('t.data_slice2_scale', $this->data_slice2_scale, true);
		$criteria->compare('t.start_date', $this->start_date, true);
		$criteria->compare('t.end_date', $this->end_date, true);
		$criteria->compare('t.created_at', $this->created_at, true);
		$criteria->compare('t.created_by', $this->created_by);
		$criteria->compare('t.updated_at', $this->updated_at, true);
		$criteria->compare('t.updated_by', $this->updated_by);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns a model used to populate a filterable, searchable
	 * and sortable CGridView with the records found by a model relation.
	 *
	 * Usage:
	 * $relatedSearchModel = $model->getRelatedSearchModel('relationName');
	 *
	 * Then, when invoking CGridView:
	 * 	...
	 * 		'dataProvider' => $relatedSearchModel->search(),
	 * 		'filter' => $relatedSearchModel,
	 * 	...
	 * @returns CActiveRecord
	 */
	public function getRelatedSearchModel($name)
	{

		$md = $this->getMetaData();
		if (!isset($md->relations[$name]))
			throw new CDbException(Yii::t('yii', '{class} does not have relation "{name}".', array('{class}' => get_class($this), '{name}' => $name)));

		$relation = $md->relations[$name];
		if (!($relation instanceof CHasManyRelation))
			throw new CException("Currently works with HAS_MANY relations only");

		$className = $relation->className;
		$related = new $className('search');
		$related->unsetAttributes();
		$related->{$relation->foreignKey} = $this->primaryKey;
		if (isset($_GET[$className]))
		{
			$related->attributes = $_GET[$className];
		}
		return $related;
	}

}
