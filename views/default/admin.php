<?php
$this->breadcrumbs[] = Yii::t('SlitSliderModule.crud', 'Slits');


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('slit-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('SlitSliderModule.crud', 'Slits'); ?> <small><?php echo Yii::t('SlitSliderModule.crud', 'Manage'); ?></small>
</h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<br />
<?php
$this->widget('TbGridView', array(
    'id' => 'slit-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'pager' => array(
        'class' => 'TbPager',
        'displayFirstAndLast' => true,
    ),
    'columns' => array(
        array(
            'name' => 'media_id',
            'type' => 'raw',
            'value' => function($data) {
                return ($data->media_id !== null) ? $data->createImageLink($data->media->image(SlitSliderWidget::imagePreset_admin), array('//slitSlider/default/view?id=' . $data->id)) : '<i class="icon-ban-circle"></i>';
            }
        ),
        'type',
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'headline',
            'editable' => array(
                'url' => $this->createUrl('/slitSlider/default/editableSaver'),
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'group_id',
            'editable' => array(
                'url' => $this->createUrl('/slitSlider/default/editableSaver'),
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'rank',
            'editable' => array(
                'url' => $this->createUrl('/slitSlider/default/editableSaver'),
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'status',
            'editable' => array(
                'url' => $this->createUrl('/slitSlider/default/editableSaver'),
                'type' => 'select',
                'source' => array(
                    'hidden' => 'hidden',
                    'published' => 'published',
                ),
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'language',
            'editable' => array(
                'url' => $this->createUrl('/slitSlider/default/editableSaver'),
            )
        ),
        array(
            'class' => 'TbButtonColumn',
            'viewButtonUrl' => "Yii::app()->controller->createUrl('view', array('id' => \$data->id))",
            'updateButtonUrl' => "Yii::app()->controller->createUrl('update', array('id' => \$data->id))",
            'deleteButtonUrl' => "Yii::app()->controller->createUrl('delete', array('id' => \$data->id))",
        ),
    #'subline',
    #'link',
    /*
      'body_html',
     */
    /*
      'rank',
      'data_orientation',
      'data_slice1_rotation',
      'data_slice2_rotation',
      'data_slice1_scale',
      'data_slice2_scale',
      'start_date',
      'end_date',
      'created_at',
      'created_by',
      'updated_at',
      'updated_by',
     */
    ),
));
?>