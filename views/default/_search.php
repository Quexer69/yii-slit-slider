<div class="wide form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>
    <div class="row">
        <div class="span6">
            <?php echo $form->label($model, 'status'); ?>
            <?php
            echo CHtml::activeDropDownList($model, 'status', $model->statusList);
            ?>
        </div>
        <div class="span6">
            <?php echo $form->label($model, 'type'); ?>
            <?php
            echo CHtml::activeDropDownList($model, 'type', $model->slitTypes);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="span6">
            <?php echo $form->label($model, 'headline'); ?>
            <?php echo $form->textField($model, 'headline', array('size' => 60, 'maxlength' => 255)); ?>
        </div>
        <div class="span6">
            <?php echo $form->label($model, 'subline'); ?>
            <?php echo $form->textField($model, 'subline', array('size' => 60, 'maxlength' => 255)); ?>
        </div>

    </div>
    <div class="row">
        <div class="span6">
            <?php echo $form->label($model, 'body_html'); ?>
            <?php echo $form->textField($model, 'body_html', array('size' => 60, 'maxlength' => 255)); ?>
        </div>
        <div class="span6">
            <?php echo $form->label($model, 'group_id'); ?>
            <?php echo $form->textField($model, 'group_id', array('size' => 60, 'maxlength' => 255)); ?>
        </div>
    </div>
    <div class="row">
        <div class="span3">
            <?php echo $form->label($model, 'created_at'); ?>
            <?php echo $form->textField($model, 'created_at'); ?>
        </div>
        <div class="span3">
            <?php echo $form->label($model, 'created_by'); ?>
            <?php echo $form->textField($model, 'created_by'); ?>
        </div>
        <div class="span3">
            <?php echo $form->label($model, 'updated_at'); ?>
            <?php echo $form->textField($model, 'updated_at'); ?>
        </div>
        <div class="span3">
            <?php echo $form->label($model, 'updated_by'); ?>
            <?php echo $form->textField($model, 'updated_by'); ?>
        </div>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('SlitSliderModule.crud', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
