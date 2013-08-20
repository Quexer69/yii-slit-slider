<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php
        echo CHtml::activeDropDownList($model, 'status', array(
            'hidden' => 'hidden',
            'published' => 'published',
        ));
        ?>
    </div>


    <div class="row">
        <?php echo $form->label($model, 'type'); ?>
<?php
echo CHtml::activeDropDownList($model, 'type', array(
    'html' => 'html',
    'image' => 'image',
));
?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'headline'); ?>
<?php echo $form->textField($model, 'headline', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'subline'); ?>
<?php echo $form->textField($model, 'subline', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'link'); ?>
<?php echo $form->textField($model, 'link', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'body_html'); ?>
        <?php echo $form->textField($model, 'body_html', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'media_id'); ?>
<?php echo $form->textField($model, 'media_id'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'group_id'); ?>
<?php echo $form->textField($model, 'group_id', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'rank'); ?>
<?php echo $form->textField($model, 'rank'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'start_date'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'start_date',
            'language' => substr(Yii::app()->language, 0, strpos(Yii::app()->language, '_')),
            'htmlOptions' => array('size' => 10),
            'options' => array(
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeYear' => true,
                'dateFormat' => 'yy-mm-dd',
            ),
                )
        );
        ;
        ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'end_date'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'end_date',
            'language' => substr(Yii::app()->language, 0, strpos(Yii::app()->language, '_')),
            'htmlOptions' => array('size' => 10),
            'options' => array(
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeYear' => true,
                'dateFormat' => 'yy-mm-dd',
            ),
                )
        );
        ;
        ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_at'); ?>
        <?php echo $form->textField($model, 'created_at'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_by'); ?>
        <?php echo $form->textField($model, 'created_by'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_at'); ?>
        <?php echo $form->textField($model, 'updated_at'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'updated_by'); ?>
<?php echo $form->textField($model, 'updated_by'); ?>
    </div>

    <div class="row buttons">
<?php echo CHtml::submitButton(Yii::t('SlitSliderModule.crud', 'Search')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
