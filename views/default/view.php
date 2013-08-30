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
                    'name'  => 'type',
                    'type'  => 'html',
                    'value' => ($model->type === 'image') 
                                ? '<span class="badge"><i class="icon-camera"></i> ' . $model->type . '</span>' 
                                : '<span class="badge"><i class="icon-barcode"></i> ' . $model->type . '</span>'
                ),
                array(
                    'name'  => 'status',
                    'type'  => 'raw',
                    'value' => $this->widget('EditableField', array(
                                        'model' => $model,
                                        'emptytext' => 'Click to select',
                                        'type' => 'select',
                                        'source' => array(
                                            'hidden' => 'hidden',
                                            'published' => 'published',
                                        ),
                                        'attribute' => 'status',
                                        'url' => $this->createUrl('/slitSlider/default/editableSaver'),
                                        'select2' => array(
                                            'placeholder' => 'Select...',
                                            'allowClear' => false
                                        )
                                    ), true
                                )
                ),
                array(
                    'name'  => 'image_preset',
                    'type'  => 'raw',
                    'value' => $this->widget('EditableField', array(
                                        'model' => $model,
                                        'emptytext' => 'Click to select',
                                        'type' => 'select',
                                        'source' => $this->module->imagePresets,
                                        'attribute' => 'image_preset',
                                        'url' => $this->createUrl('/slitSlider/default/editableSaver'),
                                        'select2' => array(
                                            'placeholder' => 'Select...',
                                            'allowClear' => false
                                        )
                                    ), true
                                )
                ),
                array(
                    'name'  => 'media_id',
                    'type'  => 'raw',
                    'value' => ($model->media_id !== null) 
                                ? CHtml::link($model->media->image(SlitSliderWidget::imagePreset_view), array('//p3media/p3Media/view?id=' . $model->media_id), array('class' => 'pull-left btn-info'))
                                : '<i class="icon-ban-circle"></i>',
                ),
                array(
                    'name'  => 'group_id',
                    'type'  => 'raw',
                    'value' => $this->widget('EditableField', array(
                                        'model' => $model,
                                        'attribute' => 'group_id',
                                        'url' => $this->createUrl('/slitSlider/default/editableSaver'),
                                    ), true
                                )
                ),
                array(
                    'name'  => 'rank',
                    'type'  => 'raw',
                    'value' => $this->widget('EditableField', array(
                                        'model' => $model,
                                        'attribute' => 'rank',
                                        'url' => $this->createUrl('/slitSlider/default/editableSaver'),
                                    ), true
                                )
                ),
                array(
                    'name'  => 'language',
                    'type'  => 'raw',
                    'value' => $this->widget('EditableField', array(
                                        'model' => $model,
                                        'attribute' => 'language',
                                        'url' => $this->createUrl('/slitSlider/default/editableSaver'),
                                    ), true
                                )
                ),
                array(
                    'name'  => 'headline',
                    'type'  => 'raw',
                    'value' => ($model->headline !== null) 
                                ? $this->widget('EditableField', array(
                                        'model' => $model,
                                        'attribute' => 'headline',
                                        'url' => $this->createUrl('/slitSlider/default/editableSaver'),
                                    ), true
                                ) 
                                : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'subline',
                    'type'  => 'raw',
                    'value' => ($model->subline !== null) 
                                ? $this->widget('EditableField', array(
                                        'model' => $model,
                                        'attribute' => 'subline',
                                        'url' => $this->createUrl('/slitSlider/default/editableSaver'),
                                    ), true
                                ) 
                                : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'link',
                    'type'  => 'raw',
                    'value' => ($model->link !== null) 
                                ? $this->widget('EditableField', array(
                                        'model' => $model,
                                        'attribute' => 'link',
                                        'url' => $this->createUrl('/slitSlider/default/editableSaver'),
                                    ), true
                                ) 
                                : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'body_html',
                    'type'  => 'raw',
                    'value' => ($model->body_html !== null) ? '<pre>' . $model->body_html . '</pre>' : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'data_orientation',
                    'type'  => 'raw',
                    'value' => ($model->data_orientation !== null) ? $model->data_orientation : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'data_slice1_rotation',
                    'type'  => 'raw',
                    'value' => ($model->data_slice1_rotation !== null) ? $model->data_slice1_rotation : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'data_slice2_rotation',
                    'type'  => 'raw',
                    'value' => ($model->data_slice2_rotation !== null) ? $model->data_slice2_rotation : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'data_slice1_scale',
                    'type'  => 'raw',
                    'value' => ($model->data_slice1_scale !== null) ? $model->data_slice1_scale : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'data_slice2_scale',
                    'type'  => 'raw',
                    'value' => ($model->data_slice2_scale !== null) ? $model->data_slice2_scale : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'start_date',
                    'type'  => 'raw',
                    'value' => ($model->start_date !== null) ? $model->start_date : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'end_date',
                    'type'  => 'raw',
                    'value' => ($model->end_date !== null) ? $model->end_date : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'created_at',
                    'type'  => 'raw',
                    'value' => ($model->created_at !== null) ? $model->created_at : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'updated_at',
                    'type'  => 'raw',
                    'value' => ($model->updated_at !== null) ? $model->updated_at : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'created_by',
                    'type'  => 'text',
                    'value' => $model->created_by
                ),
                array(
                    'name'  => 'updated_by',
                    'type'  => 'text',
                    'value' => $model->updated_by
                ),
            )
        ));
        ?>
    </div>
</div>
