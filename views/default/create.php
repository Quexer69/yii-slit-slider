<?php
$this->setPageTitle(
    Yii::t('SlitSliderModule.model', 'SlitSlider')
    . ' - '
    . Yii::t('SlitSliderModule.crud', 'Create')
);
$this->breadcrumbs[Yii::t('SlitSliderModule.crud','Slits')] = array('admin');
$this->breadcrumbs[] = Yii::t('SlitSliderModule.crud', 'Create');
?>
<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('SlitSliderModule.crud','Slit')?>
    <small>
        <?php echo Yii::t('SlitSliderModule.crud','Create')?>
    </small>
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>
<?php $this->renderPartial('_form', array('model' => $model, 'buttons' => 'create')); ?>
<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>

