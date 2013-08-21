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
                    'type' => 'html',
                    'value' => ($model->status !== null && $model->status === SlitSliderWidget::SLIT_ACTIVE) ? '<span class="badge badge-success"><i class="icon-eye-open"></i> ' . $model->status . '</span>' : '<span class="badge badge-important"><i class="icon-eye-close"></i> ' . $model->status . '</span>',
                ),
                array(
                    'name' => 'image_preset',
                    'type' => 'html',
                    'value' => SlitSliderWidget::getP3MediaPresetName($model->image_preset),
                ),
                array(
                    'name' => 'media_id',
                    'type' => 'html',
                    'value' => ($model->media_id !== null) ? $model->createImageLink($model->media_id, 'View Image', array('//p3media/p3Media/view', 'id' => $model->media_id)) : '<i class="icon-ban-circle"></i>',
                ),
                array(
                    'name' => 'group_id',
                    'type' => 'html',
                    'value' => ($model->group_id === NULL) ? '<span class="badge badge-warning"><i class="icon-flag"></i> Show on all Sliders</span> <span class="badge badge-info"><i class="icon-list"></i> ' . $model->rank . '</span>' : '<span class="badge badge-warning"><i class="icon-flag"></i> ' . $model->group_id . '</span> <span class="badge badge-info"><i class="icon-list"></i> ' . $model->rank . '</span>',
                ),
                array(
                    'name' => 'type',
                    'type' => 'html',
                    'value' => ($model->type !== null) ? '<span class="badge ">' . $model->type . '</span>' : '<i class="icon-ban-circle"></i>'
                ),
                'language',
                array(
                    'name' => 'headline',
                    'type' => 'html',
                    'value' => ($model->headline !== null) ? $model->headline : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'subline',
                    'type' => 'html',
                    'value' => ($model->subline !== null) ? $model->subline : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'link',
                    'type' => 'html',
                    'value' => ($model->link !== null) ? $model->createLink($model->link) : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'body_html',
                    'type' => 'html',
                    'value' => ($model->body_html !== null) ? '<pre>' . $model->body_html . '</pre>' : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'data_orientation',
                    'type' => 'html',
                    'value' => ($model->data_orientation !== null) ? $model->data_orientation : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'data_slice1_rotation',
                    'type' => 'html',
                    'value' => ($model->data_slice1_rotation !== null) ? $model->data_slice1_rotation : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'data_slice2_rotation',
                    'type' => 'html',
                    'value' => ($model->data_slice2_rotation !== null) ? $model->data_slice2_rotation : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'data_slice1_scale',
                    'type' => 'html',
                    'value' => ($model->data_slice1_scale !== null) ? $model->data_slice1_scale : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'data_slice2_scale',
                    'type' => 'html',
                    'value' => ($model->data_slice2_scale !== null) ? $model->data_slice2_scale : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'start_date',
                    'type' => 'raw',
                    'value' => ($model->start_date !== null) ? $model->start_date : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'end_date',
                    'type' => 'raw',
                    'value' => ($model->end_date !== null) ? $model->end_date : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'created_at',
                    'type' => 'raw',
                    'value' => ($model->created_at !== null) ? $model->created_at : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name' => 'updated_at',
                    'type' => 'raw',
                    'value' => ($model->updated_at !== null) ? $model->updated_at : '<i class="icon-ban-circle"></i>'
                ),
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