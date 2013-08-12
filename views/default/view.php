<?php
$this->breadcrumbs[Yii::t('SlitSliderModule.crud','Slits')] = array('admin');
$this->breadcrumbs[] = $model->id;
?>
<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('SlitSliderModule.crud','Slit')?> <small><?php echo Yii::t('SlitSliderModule.crud','View')?> #<?php echo $model->id ?></small></h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span8">
        
        <?php
    $this->widget('TbDetailView', array(
    'data'=>$model,
    'attributes'=>array(
            'id',
        'status',
        'language',
        'type',
        'headline',
        'subline',
        'link',
        'bodyHtml',
        'keywords',
        array(
            'name'=>'media_id',
            'value'=>($model->media_id !== null)? $model->createImageLink($model->media_id, 'View Image', 'p3media-ckbrowse'):'n/a',
            'type'=>'html',
        ),
        'page_name',
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
),
        )); ?>
    </div>

    <div class="span4">

            </div>
</div>