<?php
$this->setPageTitle(
    Yii::t('SlitSliderModule.model', 'SlitSlider')
    . ' - '
    . Yii::t('SlitSliderModule.crud', 'Update')
    . ': '
    . $model->getItemLabel()
);
$this->breadcrumbs[Yii::t('SlitSliderModule.crud','Slits')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id'=>$model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('SlitSliderModule.crud', 'Update');
?>
<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('SlitSliderModule.crud','Slit')?>
    <small>
        <?php echo Yii::t('SlitSliderModule.crud','Update')?> #<?php echo $model->id ?>
    </small>
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>
<?php $this->renderPartial('_form', array('model'=>$model));?>
<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
