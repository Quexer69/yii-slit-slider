<?php
$this->setPageTitle(
    Yii::t('SlitSliderModule.model', 'SlitSlider')
    . ' - '
    . Yii::t('SlitSliderModule.crud', 'View')
    . ': '
    . $model->getItemLabel()
);
$this->breadcrumbs[Yii::t('SlitSliderModule.crud', 'Slits')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view', 'id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('SlitSliderModule.crud', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('SlitSliderModule.crud', 'Slit') ?>
    <small>
        <?php echo $model->itemLabel ?>
    </small>
</h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>

<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('SlitSliderModule.crud', 'Data') ?>
            <small>
                #<?php echo $model->id ?>
            </small>
        </h2>
        <?php
        $this->widget('TbDetailView', array(
            'data'       => $model,
            'attributes' => array(
                'language',
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
                    'value' => $this->widget('TbEditableField', array(
                                'model'     => $model,
                                'emptytext' => 'Click to select',
                                'type'      => 'select',
                                'source'    => array(
                                    'hidden'    => 'hidden',
                                    'published' => 'published',
                                ),
                                'attribute' => 'status',
                                'url'       => $this->createUrl('/slitSlider/default/editableSaver'),
                                'select2'   => array(
                                    'placeholder' => 'Select...',
                                    'allowClear'  => FALSE
                                )
                            ), TRUE
                        )
                ),
                array(
                    'name'  => 'image_preset',
                    'type'  => 'raw',
                    'value' => $this->widget('TbEditableField', array(
                                'model'     => $model,
                                'emptytext' => 'Click to select',
                                'type'      => 'select',
                                'source'    => $this->module->imagePresets,
                                'attribute' => 'image_preset',
                                'url'       => $this->createUrl('/slitSlider/default/editableSaver'),
                                'select2'   => array(
                                    'placeholder' => 'Select...',
                                    'allowClear'  => FALSE
                                )
                            ), TRUE
                        ),
                    'visible' => isset($model->media_id)
                ),
                array(
                    'name'  => 'media_id',
                    'type'  => 'raw',
                    'value' => ($model->media !== NULL)
                            ? CHtml::link($model->media->image(SlitSliderWidget::IMAGE_PRESET_VIEW),
                                Yii::app()->controller->createUrl(
                                    '//p3media/p3Media/view?id=' . $model->media_id, array()))
                            : '<i class="icon-ban-circle"></i>',
                    'visible' => isset($model->media_id)
                ),
                array(
                    'name'  => 'group_id',
                    'type'  => 'raw',
                    'value' => $this->widget('TbEditableField', array(
                                'model'     => $model,
                                'attribute' => 'group_id',
                                'url'       => $this->createUrl('/slitSlider/default/editableSaver'),
                            ), TRUE
                        )
                ),
                array(
                    'name'  => 'rank',
                    'type'  => 'raw',
                    'value' => $this->widget('TbEditableField', array(
                                'model'     => $model,
                                'attribute' => 'rank',
                                'url'       => $this->createUrl('/slitSlider/default/editableSaver'),
                            ), TRUE
                        )
                ),
                array(
                    'name'  => 'headline',
                    'type'  => 'raw',
                    'value' => ($model->headline !== NULL)
                            ? $this->widget('TbEditableField', array(
                                    'model'     => $model,
                                    'attribute' => 'headline',
                                    'url'       => $this->createUrl('/slitSlider/default/editableSaver'),
                                ), TRUE
                            )
                            : '<i class="icon-ban-circle"></i>',
                    'visible' => isset($model->headline)
                ),
                array(
                    'name'  => 'subline',
                    'type'  => 'raw',
                    'value' => ($model->subline !== NULL)
                            ? $this->widget('TbEditableField', array(
                                    'model'     => $model,
                                    'attribute' => 'subline',
                                    'url'       => $this->createUrl('/slitSlider/default/editableSaver'),
                                ), TRUE
                            )
                            : '<i class="icon-ban-circle"></i>',
                    'visible' => isset($model->subline)
                ),
                array(
                    'name'    => 'link',
                    'type'    => 'raw',
                    'value'   => ($model->link !== NULL)
                            ? $this->widget('TbEditableField', array(
                                    'model'     => $model,
                                    'attribute' => 'link',
                                    'url'       => $this->createUrl('/slitSlider/default/editableSaver'),
                                ), TRUE
                            )
                            : '<i class="icon-ban-circle"></i>',
                    'visible' => isset($model->link)
                ),
                array(
                    'name'    => 'body_html',
                    'type'    => 'raw',
                    'value'   => ($model->body_html !== NULL) ? '<pre>' . $model->body_html . '</pre>' : '<i class="icon-ban-circle"></i>',
                    'visible' => isset($model->body_html)
                ),
                array(
                    'name'    => 'data_orientation',
                    'type'    => 'raw',
                    'value' => $this->widget('TbEditableField', array(
                            'model'     => $model,
                            'emptytext' => 'Click to select',
                            'type'      => 'select',
                            'source'    => array(
                                'horizontal' => 'horizontal',
                                'vertical'   => 'vertical',
                            ),
                            'attribute' => 'data_orientation',
                            'url'       => $this->createUrl('/slitSlider/default/editableSaver'),
                            'select2'   => array(
                                'placeholder' => 'Select...',
                                'allowClear'  => FALSE
                            )
                        ), TRUE
                    ),
                    'visible' => isset($model->data_orientation)
                ),
                array(
                    'name'    => 'data_slice1_rotation',
                    'type'    => 'raw',
                    'value'   => ($model->data_slice1_rotation !== NULL) ? $model->data_slice1_rotation : '<i class="icon-ban-circle"></i>',
                    'visible' => isset($model->data_slice1_rotation)
                ),
                array(
                    'name'    => 'data_slice2_rotation',
                    'type'    => 'raw',
                    'value'   => ($model->data_slice2_rotation !== NULL) ? $model->data_slice2_rotation : '<i class="icon-ban-circle"></i>',
                    'visible' => isset($model->data_slice2_rotation)
                ),
                array(
                    'name'    => 'data_slice1_scale',
                    'type'    => 'raw',
                    'value'   => ($model->data_slice1_scale !== NULL) ? $model->data_slice1_scale : '<i class="icon-ban-circle"></i>',
                    'visible' => isset($model->data_slice1_scale)
                ),
                array(
                    'name'    => 'data_slice2_scale',
                    'type'    => 'raw',
                    'value'   => ($model->data_slice2_scale !== NULL) ? $model->data_slice2_scale : '<i class="icon-ban-circle"></i>',
                    'visible' => isset($model->data_slice2_scale)
                ),
                array(
                    'name'    => 'start_date',
                    'type'    => 'raw',
                    'value'   => ($model->start_date !== NULL) ? $model->start_date : '<i class="icon-ban-circle"></i>',
                    'visible' => isset($model->start_date)
                ),
                array(
                    'name'    => 'end_date',
                    'type'    => 'raw',
                    'value'   => ($model->end_date !== NULL) ? $model->end_date : '<i class="icon-ban-circle"></i>',
                    'visible' => isset($model->end_date)
                ),
                array(
                    'name'  => 'created_at',
                    'type'  => 'raw',
                    'value' => ($model->created_at !== NULL) ? $model->created_at : '<i class="icon-ban-circle"></i>'
                ),
                array(
                    'name'  => 'updated_at',
                    'type'  => 'raw',
                    'value' => $model->updated_at,
                    'visible' => isset($model->updated_at)
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
