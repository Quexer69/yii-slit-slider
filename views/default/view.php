<?php
$this->breadcrumbs[Yii::t('SlitSliderModule.crud', 'Slits')] = array('admin');
$this->breadcrumbs[] = $model->id;
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('SlitSliderModule.crud', 'Slit') ?> <small><?php echo Yii::t('SlitSliderModule.crud', 'View') ?> #<?php echo $model->id ?></small></h1>



<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>

<div class="row">
    <div class="span8">
        <br /><br />
        <?php
        $this->widget('TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                #'id',
                array(
                    'name' => 'status',
                    'type' => 'raw',
                    'value' => ($model->status !== null && $model->status === SlitSliderWidget::SLIT_ACTIVE) ? '<span class="badge badge-success"><i class="icon-eye-open"></i> ' . $model->status . '</span>' : '<span class="badge badge-important"><i class="icon-eye-close"></i> ' . $model->status . '</span>',
                ),
                array(
                    'name' => 'image_preset',
                    'type' => 'raw',
                    'value' => SlitSliderWidget::getP3MediaPresetName($model->image_preset),
                ),
                array(
                    'name' => 'media_id',
                    'type' => 'raw',
                    'value' => ($model->media_id !== null) ? $model->createImageLink($model->media_id, 'View Image', array('//p3media/p3Media/view', 'id' => $model->media_id)) : 'n/a',
                ),
                array(
                    'name' => 'group_id',
                    'type' => 'raw',
                    'value' => ($model->group_id === NULL) ? '<span class="badge badge-warning">Show on all Sliders</span>' : '<span class="badge badge-warning">Group:</span>' . '<span class="badge badge-warning">' . $model->group_id . '</span> | <span class="badge badge-info">Pos:</span><span class="badge badge-info">' . $model->rank . '</span>',
                ),
                'language',
                'type',
                array(
                    'name' => 'body_html',
                    'type' => 'raw',
                    'value' => ($model->body_html !== null) ? '<pre>' . $model->body_html . '</pre>' : '<i class="icon-ban-circle"></i>'
                ),
                'headline',
                'subline',
                'link',
                'data_orientation',
                'data_slice1_rotation',
                'data_slice2_rotation',
                'data_slice1_scale',
                'data_slice2_scale',
                'start_date',
                'end_date',
                'created_at',
                'updated_at',
                array(
                    'name' => 'created_by',
                    'type' => 'text',
                    'value' => $model->created_by
                ),
                array(
                    'name' => 'updated_by',
                    'type' => 'text',
                    'value' => $model->updated_by
                ),
            )
        ));
        ?>
    </div>

    <div class="span4">

    </div>
</div>