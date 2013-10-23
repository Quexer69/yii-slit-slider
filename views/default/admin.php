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

<h1><?php echo Yii::t('SlitSliderModule.crud', 'Slits'); ?> <small><?php echo Yii::t('SlitSliderModule.crud', 'Manage'); ?></small></h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<br />
<?php
$this->widget('TbGridView', array(
    'id'            => 'slit-grid',
    'dataProvider'  => $model->search(),
    'filter'        => $model,
    'pager'         => array(
                        'class' => 'TbPager',
                        'displayFirstAndLast' => true,
    ),
    'columns' => array(
        array(
            'name'  => 'media_id',
            'type'  => 'raw',
            'value' => function($data) {
                return ($data->media_id !== null) 
                        ? CHtml::link($data->media->image(SlitSliderWidget::imagePreset_admin),
                                       Yii::app()->controller->createUrl(
                                               '//slitSlider/default/view?id=' . $data->id, array()))
                        : '<i class="icon-ban-circle"></i>';
            }   
        ),
        'type',
        array(
            'class' => 'TbEditableColumn',
            'name'  => 'headline',
            'editable' => array('url'   => $this->createUrl('/slitSlider/default/editableSaver'))
        ),
        array(
            'class' => 'TbEditableColumn',
            'name'  => 'group_id',
            'editable' => array('url'   => $this->createUrl('/slitSlider/default/editableSaver'))
        ),
        array(
            'class' => 'TbEditableColumn',
            'name'  => 'rank',
            'editable' => array('url'   => $this->createUrl('/slitSlider/default/editableSaver'))
        ),
        array(
            'class' => 'TbEditableColumn',
            'name'  => 'status',
            'editable' => array('url'   => $this->createUrl('/slitSlider/default/editableSaver'),
                                'type'  => 'select',
                                'source' => array(
                                    'hidden' => 'hidden',
                                    'published' => 'published',
                                ),
                            )
        ),
        array(
            'class' => 'TbEditableColumn',
            'name'  => 'language',
            'editable' => array('url'   => $this->createUrl('/slitSlider/default/editableSaver'))
        ),
        array(
            'class' => 'TbButtonColumn',
            'viewButtonUrl'             => "Yii::app()->controller->createUrl('view', array('id' => \$data->id))",
            'updateButtonUrl'           => "Yii::app()->controller->createUrl('update', array('id' => \$data->id))",
            'deleteButtonUrl'           => "Yii::app()->controller->createUrl('delete', array('id' => \$data->id))",
        ),
    ),
));
?>