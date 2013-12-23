<?php
$this->setPageTitle(
    Yii::t('SlitSliderModule.model', 'SlitSlider')
    . ' - '
    . Yii::t('SlitSliderModule.crud', 'Admin')
);

$this->breadcrumbs[] = Yii::t('SlitSliderModule.crud', 'Slits');

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'slit-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
");
?>
<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>

<h1>
    <?php echo Yii::t('SlitSliderModule.crud', 'Slits'); ?>
    <small>
        <?php echo Yii::t('SlitSliderModule.crud', 'Manage'); ?>
    </small>
</h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php Yii::beginProfile('SlitSlider.admin.grid'); ?>

<?php
$this->widget('TbGridView', array(
    'id'           => 'slit-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'template' => '{summary}{pager}{items}{pager}',
    'pager'        => array(
        'class'               => 'TbPager',
        'displayFirstAndLast' => TRUE,
    ),
    'columns'      => array(
        array(
            'name'  => 'media_id',
            'type'  => 'raw',
            'value' => function ($data) {
                    return ($data->media !== NULL)
                        ? CHtml::link($data->media->image(SlitSliderWidget::IMAGE_PRESET_ADMIN),
                            Yii::app()->controller->createUrl(
                                '//slitSlider/default/view?id=' . $data->id, array()))
                        : '<i class="icon-ban-circle"></i>';
                }
        ),
        'type',
        array(
            'class'    => 'TbEditableColumn',
            'name'     => 'headline',
            'editable' => array('url' => $this->createUrl('/slitSlider/default/editableSaver'))
        ),
        array(
            'class'    => 'TbEditableColumn',
            'name'     => 'group_id',
            'editable' => array('url' => $this->createUrl('/slitSlider/default/editableSaver'))
        ),
        array(
            'class'    => 'TbEditableColumn',
            'name'     => 'rank',
            'editable' => array('url' => $this->createUrl('/slitSlider/default/editableSaver'))
        ),
        array(
            'class'    => 'TbEditableColumn',
            'name'     => 'status',
            'editable' => array('url'    => $this->createUrl('/slitSlider/default/editableSaver'),
                                'type'   => 'select',
                                'source' => array(
                                    'hidden'    => 'hidden',
                                    'published' => 'published',
                                ),
            )
        ),
        'language',
        array(
            'class'           => 'TbButtonColumn',
            'buttons'         => array(
                'view'   => array('visible' => 'Yii::app()->user->checkAccess("SlitSlider.Default.View")   || Yii::app()->user->checkAccess("SlitSlider.Default.*")'),
                'update' => array('visible' => 'Yii::app()->user->checkAccess("SlitSlider.Default.Update") || Yii::app()->user->checkAccess("SlitSlider.Default.*")'),
                'delete' => array('visible' => 'Yii::app()->user->checkAccess("SlitSlider.Default.Delete") || Yii::app()->user->checkAccess("SlitSlider.Default.*")'),
            ),
            'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("id" => $data->id))',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("id" => $data->id))',
            'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("id" => $data->id))',
        ),
    ),
));
?>
