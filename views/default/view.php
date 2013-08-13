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

        <?php
        $this->widget('TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                #'id',
                array(
                    'name' => 'media_id',
                    'type' => 'raw',
                    'value' => ($model->media_id !== null) ? $model->createImageLink($model->media_id, 'View Image', array('//p3media/p3Media/view', 'id' => $model->media_id), 'small') : 'n/a',
                ),
                array(
                    'name' => 'status',
                    'type' => 'raw',
                    'value' => ($model->status !== null && $model->status === SlitSliderWidget::SLIT_ACTIVE) ? '<span class="badge badge-success"><i class="icon-thumbs-up icon-2x"></i> ' . $model->status . '</span>' : '<span class="badge badge-danger"><i class="icon-square icon-thumbs-down"></i> ' . $model->status . '</span>',
                ),
                'language',
                'keywords',
                'type',
                array(
                    'name' => 'bodyHtml',
                    'type' => 'raw',
                    'value' => ($model->bodyHtml !== null) ? '<pre>' . $model->bodyHtml . '</pre>' : '<i class="icon-ban-circle"></i>'
                ),
                'headline',
                'subline',
                'link',
                array(
                    'name' => 'page_id',
                    'type' => 'raw',
                    'value' => '<span class="badge badge-warning">' . $model->page_id . '</span>',
                ),
                array(
                    'name' => 'rank',
                    'type' => 'raw',
                    'value' => '<span class="badge badge-info"># ' . $model->rank . '</span>',
                ),
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
                    'value' => $model->getFullUserId($model->created_by)
                ),
                array(
                    'name' => 'updated_by',
                    'type' => 'text',
                    'value' => $model->getFullUserId($model->updated_by)
                ),
            )
        ));
        ?>
    </div>

    <div class="span4">

    </div>
</div>