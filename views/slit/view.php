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
        <h2>
            <?php echo Yii::t('SlitSliderModule.crud','Data')?>        </h2>

        <h3>
            <?php echo $model->itemLabel?>        </h3>


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
        'media_id',
        'page_name',
        'rank',
        'custom_attributes',
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