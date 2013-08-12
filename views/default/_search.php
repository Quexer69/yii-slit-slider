<div class="wide form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

                    <div class="row">
            <?php echo $form->label($model,'id'); ?>
                            <?php echo $form->textField($model,'id'); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'status'); ?>
                            <?php echo CHtml::activeDropDownList($model, 'status', array(
			'hidden' => 'hidden' ,
			'published' => 'published' ,
)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'language'); ?>
                            <?php echo $form->textField($model,'language',array('size'=>8,'maxlength'=>8)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'type'); ?>
                            <?php echo CHtml::activeDropDownList($model, 'type', array(
			'html' => 'html' ,
			'image' => 'image' ,
)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'headline'); ?>
                            <?php echo $form->textField($model,'headline',array('size'=>60,'maxlength'=>255)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'subline'); ?>
                            <?php echo $form->textField($model,'subline',array('size'=>60,'maxlength'=>255)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'link'); ?>
                            <?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>255)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'bodyHtml'); ?>
                            <?php $this->widget('ckeditor.CKEditor', array('model'=>$model,'attribute'=>'bodyHtml','options'=>Yii::app()->params['ext.ckeditor.options']));; ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'keywords'); ?>
                            <?php echo $form->textField($model,'keywords',array('size'=>60,'maxlength'=>255)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'media_id'); ?>
                            <?php echo $form->textField($model,'media_id'); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'page_id'); ?>
                            <?php echo $form->textField($model,'page_id',array('size'=>60,'maxlength'=>255)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'rank'); ?>
                            <?php echo $form->textField($model,'rank'); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'data_orientation'); ?>
                            <?php echo $form->textField($model,'data_orientation',array('size'=>10,'maxlength'=>10)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'data_slice1_rotation'); ?>
                            <?php echo $form->textField($model,'data_slice1_rotation',array('size'=>5,'maxlength'=>5)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'data_slice2_rotation'); ?>
                            <?php echo $form->textField($model,'data_slice2_rotation',array('size'=>5,'maxlength'=>5)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'data_slice1_scale'); ?>
                            <?php echo $form->textField($model,'data_slice1_scale',array('size'=>5,'maxlength'=>5)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'data_slice2_scale'); ?>
                            <?php echo $form->textField($model,'data_slice2_scale',array('size'=>5,'maxlength'=>5)); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'start_date'); ?>
                            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
						 array(
								 'model'=>$model,
								 'attribute'=>'start_date',
								 'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
								 'htmlOptions'=>array('size'=>10),
								 'options'=>array(
									 'showButtonPanel'=>true,
									 'changeYear'=>true,
									 'changeYear'=>true,
									 'dateFormat'=>'yy-mm-dd',
									 ),
								 )
							 );
					; ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'end_date'); ?>
                            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
						 array(
								 'model'=>$model,
								 'attribute'=>'end_date',
								 'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
								 'htmlOptions'=>array('size'=>10),
								 'options'=>array(
									 'showButtonPanel'=>true,
									 'changeYear'=>true,
									 'changeYear'=>true,
									 'dateFormat'=>'yy-mm-dd',
									 ),
								 )
							 );
					; ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'created_at'); ?>
                            <?php echo $form->textField($model,'created_at'); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'created_by'); ?>
                            <?php echo $form->textField($model,'created_by'); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'updated_at'); ?>
                            <?php echo $form->textField($model,'updated_at'); ?>
                    </div>

                    <div class="row">
            <?php echo $form->label($model,'updated_by'); ?>
                            <?php echo $form->textField($model,'updated_by'); ?>
                    </div>

        <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('SlitSliderModule.crud', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
