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
                return ($data->media_id !== null) ? $data->createImageLink($data->media_id, 'View Image', array('//slitSlider/default/view', 'id' => $data->id), 'p3media-upload') : '<i class="icon-ban-circle"></i>';
            }
        ),
        array(
            'name' => 'headline',
            'type' => 'html',
            'value' => function($data) {
                return ($data->headline !== null) ? $data->headline : '<i class="icon-ban-circle"></i>';
            }
        ),
        array(
            'name' => 'group_id',
            'type' => 'raw',
            'value' => function($data) {
                return ($data->group_id === NULL) ? '<span class="badge badge-warning"><i class="icon-flag"></i> Show on all Sliders</span>' : '<span class="badge badge-warning"><i class="icon-flag"></i> ' . $data->group_id . '</span>';
            }
        ),
        array(
            'name' => 'rank',
            'type' => 'raw',
            'value' => function($data) {
                return '<span class="badge badge-info"><i class="icon-list"></i> ' . $data->rank . '</span>';
            }
        ),
        array(
            'name' => 'status',
            'type' => 'raw',
            'value' => function($data) {
                return ($data->status !== null && $data->status === SlitSliderWidget::SLIT_ACTIVE) ? '<span class="badge badge-success"><i class="icon-eye-open"></i> ' . $data->status . '</span>' : '<span class="badge badge-important"><i class="icon-eye-close"></i> ' . $data->status . '</span>';
            }
        ),
        'language',
        'type',
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