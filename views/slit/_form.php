<div class="crud-form">

    <?php
    Yii::app()->bootstrap->registerAssetCss('select2.css');
    Yii::app()->bootstrap->registerAssetJs('select2.js');
    Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'slit-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    ));

    echo $form->errorSummary($model);

    ?>
    <div class="row">
        <div class="span8"> <!-- main inputs -->
            <h2>
                <?php echo Yii::t('SlitSliderModule.crud','Data')?>            </h2>

            <h3>
                <?php echo $model->itemLabel?>            </h3>

            <div class="form-horizontal">
                
    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'status'); ?></div>

            <div class='controls'><?php echo CHtml::activeDropDownList($model, 'status', array(
			'hidden' => 'hidden' ,
			'published' => 'published' ,
)); ?></div>
            <?php echo $form->error($model,'status'); ?>
            <?php if('help.status' != $help = Yii::t('SlitSliderModule.crud', 'help.status')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'language'); ?></div>
            <div class='controls'><?php echo $form->textField($model,'language',array('size'=>8,'maxlength'=>8)); ?></div>
            <?php echo $form->error($model,'language'); ?>
            <?php if('help.language' != $help = Yii::t('SlitSliderModule.crud', 'help.language')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'type'); ?></div>
            <div class='controls'><?php echo CHtml::activeDropDownList($model, 'type', array(
			'html' => 'html' ,
			'image' => 'image' ,
)); ?></div>
            <?php echo $form->error($model,'type'); ?>
            <?php if('help.type' != $help = Yii::t('SlitSliderModule.crud', 'help.type')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'headline'); ?></div>
            <div class='controls'><?php echo $form->textField($model,'headline',array('size'=>60,'maxlength'=>255)); ?></div>
            <?php echo $form->error($model,'headline'); ?>
            <?php if('help.headline' != $help = Yii::t('SlitSliderModule.crud', 'help.headline')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'subline'); ?></div>
            <div class='controls'><?php echo $form->textField($model,'subline',array('size'=>60,'maxlength'=>255)); ?></div>
            <?php echo $form->error($model,'subline'); ?>
            <?php if('help.subline' != $help = Yii::t('SlitSliderModule.crud', 'help.subline')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'link'); ?></div>
            <div class='controls'><?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>255)); ?></div>
            <?php echo $form->error($model,'link'); ?>
            <?php if('help.link' != $help = Yii::t('SlitSliderModule.crud', 'help.link')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'bodyHtml'); ?></div>
            <div class='controls'><?php $this->widget('ckeditor.CKEditor', array('model'=>$model,'attribute'=>'bodyHtml','options'=>Yii::app()->params['ext.ckeditor.options']));; ?></div>
            <?php echo $form->error($model,'bodyHtml'); ?>
            <?php if('help.bodyHtml' != $help = Yii::t('SlitSliderModule.crud', 'help.bodyHtml')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'keywords'); ?></div>
            <div class='controls'><?php echo $form->textField($model,'keywords',array('size'=>60,'maxlength'=>255)); ?></div>
            <?php echo $form->error($model,'keywords'); ?>
            <?php if('help.keywords' != $help = Yii::t('SlitSliderModule.crud', 'help.keywords')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'media_id'); ?></div>
            <div class='controls'><?php echo $form->dropDownList($model,'media_id', SlitSliderWidget::getP3MediaNames(), array('size'=>60,'maxlength'=>255)); ?></div>
            <?php echo $form->error($model,'media_id'); ?>
            <?php if('help.media_id' != $help = Yii::t('SlitSliderModule.crud', 'help.media_id')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'page_name'); ?></div>
            <div class='controls'><?php echo $form->dropDownList($model,'page_name', SlitSliderWidget::getP3Pages(), array('size'=>60,'maxlength'=>255)); ?></div>
            <?php echo $form->error($model,'page_name'); ?>
            <?php if('help.page_name' != $help = Yii::t('SlitSliderModule.crud', 'help.page_name')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'rank'); ?></div>
            <div class='controls'><?php echo $form->textField($model,'rank'); ?></div>
            <?php echo $form->error($model,'rank'); ?>
            <?php if('help.rank' != $help = Yii::t('SlitSliderModule.crud', 'help.rank')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'custom_attributes'); ?></div>
            <div class='controls'><?php echo $form->textField($model,'custom_attributes',array('size'=>60,'maxlength'=>255)); ?></div>
            <?php echo $form->error($model,'custom_attributes'); ?>
            <?php if('help.custom_attributes' != $help = Yii::t('SlitSliderModule.crud', 'help.custom_attributes')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'start_date'); ?></div>
            <div class='controls'><?php $this->widget('zii.widgets.jui.CJuiDatePicker',
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
					; ?></div>
            <?php echo $form->error($model,'start_date'); ?>
            <?php if('help.start_date' != $help = Yii::t('SlitSliderModule.crud', 'help.start_date')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'end_date'); ?></div>
            <div class='controls'><?php $this->widget('zii.widgets.jui.CJuiDatePicker',
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
					; ?></div>
            <?php echo $form->error($model,'end_date'); ?>
            <?php if('help.end_date' != $help = Yii::t('SlitSliderModule.crud', 'help.end_date')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'created_at'); ?></div>
            <div class='controls'><?php echo $form->textField($model,'created_at'); ?></div>
            <?php echo $form->error($model,'created_at'); ?>
            <?php if('help.created_at' != $help = Yii::t('SlitSliderModule.crud', 'help.created_at')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'created_by'); ?></div>
            <div class='controls'><?php echo $form->textField($model,'created_by'); ?></div>
            <?php echo $form->error($model,'created_by'); ?>
            <?php if('help.created_by' != $help = Yii::t('SlitSliderModule.crud', 'help.created_by')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'updated_at'); ?></div>
            <div class='controls'><?php echo $form->textField($model,'updated_at'); ?></div>
            <?php echo $form->error($model,'updated_at'); ?>
            <?php if('help.updated_at' != $help = Yii::t('SlitSliderModule.crud', 'help.updated_at')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>


    <div class="control-group">
            <div class='control-label'><?php echo $form->labelEx($model,'updated_by'); ?></div>
            <div class='controls'><?php echo $form->textField($model,'updated_by'); ?></div>
            <?php echo $form->error($model,'updated_by'); ?>
            <?php if('help.updated_by' != $help = Yii::t('SlitSliderModule.crud', 'help.updated_by')) { 
                echo "<span class='help-block'>{$help}</span>";            
} ?>
    </div>

            </div>
        </div>
        <!-- main inputs -->

        <div class="span4"> <!-- sub inputs -->
            <h2>
                <?php echo Yii::t('SlitSliderModule.crud','Relations')?>            </h2>
            


        </div>
        <!-- sub inputs -->
    </div>

    <p class="alert">
        <?php echo Yii::t('SlitSliderModule.crud','Fields with <span class="required">*</span> are required.');?> 
    </p>

    <div class="form-actions">
        
    <?php
        echo CHtml::Button(Yii::t('SlitSliderModule.crud', 'Cancel'), array(
			'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('slit/admin'),
			'class' => 'btn'
			));
        echo ' '.CHtml::submitButton(Yii::t('SlitSliderModule.crud', 'Save'), array(
            'class' => 'btn btn-primary'
            ));
    ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->