<div class="crud-form">

    <?php
    Yii::app()->bootstrap->registerAssetCss('select2.css');
    Yii::app()->bootstrap->registerAssetJs('select2.js');
    Yii::app()->clientScript->registerScript('crud/variant/update', '$(".crud-form select").select2();');

    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'slit-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ));
    ?>
    <hr>
    <div class="">
        <?php
        echo CHtml::Button(Yii::t('SlitSliderModule.crud', 'Cancel'), array(
            'submit' => (isset($_GET['returnUrl'])) ? $_GET['returnUrl'] : array('admin'),
            'class' => 'btn'
        ));
        echo ' ' . CHtml::submitButton(Yii::t('SlitSliderModule.crud', 'Save'), array(
            'class' => 'btn btn-primary'
        ));
        ?>
    </div>
    <?php echo $form->errorSummary($model); ?>
    <hr>
    <div class="row">
        <div class="span8"> <!-- main inputs -->
            <h4><?php echo Yii::t('SlitSliderModule.crud', 'Basic setup'); ?></h4>
            <br />
            <div class="form-horizontal">
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <div class='control-label'><?php echo $form->labelEx($model, 'status'); ?></div>

                            <div class='controls'><?php
                                echo CHtml::activeDropDownList($model, 'status', array(
                                    'hidden' => 'hidden',
                                    'published' => 'published',
                                        ), array(
                                    'class' => 'span12'
                                ));
                                ?>
                            </div>
                            <?php echo $form->error($model, 'status'); ?>
                            <?php
                            if ('help.status' != $help = Yii::t('SlitSliderModule.crud', 'help.status')) {
                                echo "<span class='help-block'>{$help}</span>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <div class='control-label muted'><?php //echo $form->labelEx($model, 'start_date');   ?></div>
                            <div class='controls'><?php
//                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                                    'model' => $model,
//                                    'attribute' => 'start_date',
//                                    'language' => substr(Yii::app()->language, 0, strpos(Yii::app()->language, '_')),
//                                    'htmlOptions' => array('size' => 20, 'readonly' => false, 'placeholder' => 'Choose...'),
//                                    'options' => array(
//                                        'showButtonPanel' => false,
//                                        'disable' => true,
//                                        'changeYear' => true,
//                                        'changeYear' => true,
//                                        'dateFormat' => 'yy-mm-dd',
//                                    ),
//                                        )
//                                );
//                                ;
                                ?></div>
                            <?php echo $form->error($model, 'start_date'); ?>
                            <?php
                            if ('help.start_date' != $help = Yii::t('SlitSliderModule.crud', 'help.start_date')) {
                                echo "<span class='help-block'>{$help}</span>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <div class='control-label'><?php echo $form->labelEx($model, 'type'); ?></div>
                            <div class='controls'><?php
                                echo CHtml::activeDropDownList($model, 'type', array(
                                    'image' => 'image',
                                    'html' => 'html',
                                        ), array(
                                    'class' => 'span12'
                                ));
                                ?>
                            </div>
                            <?php echo $form->error($model, 'type'); ?>
                            <?php
                            if ('help.type' != $help = Yii::t('SlitSliderModule.crud', 'help.type')) {
                                echo "<span class='help-block'>{$help}</span>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <div class='control-label muted'><?php //echo $form->labelEx($model, 'end_date');   ?></div>
                            <div class='controls'><?php
//                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                                    'model' => $model,
//                                    'attribute' => 'end_date',
//                                    'language' => substr(Yii::app()->language, 0, strpos(Yii::app()->language, '_')),
//                                    'htmlOptions' => array('size' => 20, 'readonly' => false, 'placeholder' => 'Choose...'),
//                                    'options' => array(
//                                        'showButtonPanel' => false,
//                                        'changeYear' => true,
//                                        'changeYear' => true,
//                                        'dateFormat' => 'yy-mm-dd',
//                                    ),
//                                        )
//                                );
//                                ;
                                ?></div>
                            <?php echo $form->error($model, 'end_date'); ?>
                            <?php
                            if ('help.end_date' != $help = Yii::t('SlitSliderModule.crud', 'help.end_date')) {
                                echo "<span class='help-block'>{$help}</span>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <hr>
                <div id="slit_image">
                    <h4><?php echo Yii::t('SlitSliderModule.crud', 'Image Slit'); ?></h4>
                    <div class="control-group">
                        <div class='control-label'><?php echo $form->labelEx($model, 'headline'); ?></div>
                        <div class='controls'><?php echo $form->textField($model, 'headline', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'Required')); ?></div>
                        <?php echo $form->error($model, 'headline'); ?>
                        <?php
                        if ('help.headline' != $help = Yii::t('SlitSliderModule.crud', 'help.headline')) {
                            echo "<span class='help-block'>{$help}</span>";
                        }
                        ?>
                    </div>
                    <div class="control-group">
                        <div class='control-label'><?php echo $form->labelEx($model, 'subline'); ?></div>
                        <div class='controls'><?php echo $form->textField($model, 'subline', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'Optional')); ?></div>
                        <?php echo $form->error($model, 'subline'); ?>
                        <?php
                        if ('help.subline' != $help = Yii::t('SlitSliderModule.crud', 'help.subline')) {
                            echo "<span class='help-block'>{$help}</span>";
                        }
                        ?>
                    </div>
                    <div class="control-group">
                        <div class='control-label'><?php echo $form->labelEx($model, 'link'); ?></div>
                        <div class='controls'><?php echo $form->textField($model, 'link', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'INTERN (controller/action), EXTERN (http://url.com) (Optional)')); ?></div>
                        <?php echo $form->error($model, 'link'); ?>
                        <?php
                        if ('help.link' != $help = Yii::t('SlitSliderModule.crud', 'help.link')) {
                            echo "<span class='help-block'>{$help}</span>";
                        }
                        ?>
                    </div>
                </div>

                <div id="slit_html">
                    <h4><?php echo Yii::t('SlitSliderModule.crud', 'HTML Slit'); ?></h4>          
                    <div class="control-group">
                        <div class='control-label'><?php echo $form->labelEx($model, 'body_html'); ?></div>
                        <div class='controls'><?php echo $form->textArea($model, 'body_html', array('rows' => 6, 'cols' => 60, 'placeholder' => 'Put your HTML Code hier, i.e. YouTube embed code')); ?></div>
                        <?php echo $form->error($model, 'body_html'); ?>
                        <?php
                        if ('help.body_html' != $help = Yii::t('SlitSliderModule.crud', 'help.body_html')) {
                            echo "<span class='help-block'>{$help}</span>";
                        }
                        ?>
                    </div>
                </div>

                <hr>
                <h4><?php echo Yii::t('SlitSliderModule.crud', 'Assignment'); ?></h4>
                <div id="slit_image_assignment">
                    <div class="control-group">
                        <div class='control-label'><?php echo $form->labelEx($model, 'media_id'); ?></div>

                        <div class='controls'><?php $this->widget('p3media.components.P3MediaSelect', array('model' => $model, 'attribute' => 'media_id')); ?></div>
                        <?php echo $form->error($model, 'media_id'); ?>
                        <?php
                        if ('help.media_id' != $help = Yii::t('SlitSliderModule.crud', 'help.media_id')) {
                            echo "<span class='help-block'>{$help}</span>";
                        }
                        ?>
                    </div>
                    <div class="control-group">
                        <div class='control-label'><?php echo $form->labelEx($model, 'image_preset'); ?></div>
                        <?php
                        $this->widget('bootstrap.widgets.TbButton', array(
                            'label' => 'Info',
                            'icon' => 'icon-info-sign',
                            'type' => 'info',
                            'htmlOptions' => array('class' => 'pull-right', 'data-placement' => 'left', 'data-content' => SlitSliderWidget::getImageModeInfo(), 'rel' => 'popover'),
                        ));
                        ?> 
                        <div class='controls'><?php echo $form->dropDownList($model, 'image_preset', $this->module->imagePresets, array('class' => 'span10', 'placeholder' => 'Choose Image Preset')); ?></div>
                        <?php echo $form->error($model, 'image_preset'); ?>
                        <?php
                        if ('help.image_preset' != $help = Yii::t('SlitSliderModule.crud', 'help.image_preset')) {
                            echo "<span class='help-block'>{$help}</span>";
                        }
                        ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class='control-label'><?php echo $form->labelEx($model, 'group_id'); ?></div>
                    <div class='controls'><?php echo $form->textField($model, 'group_id', array('placeholder' => 'Assign to group', 'class' => 'span6')); ?></div>
                    <?php echo $form->error($model, 'group_id'); ?>
                    <?php
                    if ('help.group_id' != $help = Yii::t('SlitSliderModule.crud', 'help.group_id')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>


                <div class="control-group">
                    <div class='control-label'><?php echo $form->labelEx($model, 'rank'); ?></div>
                    <div class='controls'><?php echo $form->textField($model, 'rank', array('placeholder' => 'Position within a slider group', 'class' => 'span6')); ?></div>
                    <?php echo $form->error($model, 'rank'); ?>
                    <?php
                    if ('help.rank' != $help = Yii::t('SlitSliderModule.crud', 'help.rank')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>

                <hr>
                <h4><?php echo Yii::t('SlitSliderModule.crud', 'Style & Effects'); ?></h4>
                <div class="control-group">
                    <div class='control-label'><?php echo $form->labelEx($model, 'data_orientation'); ?></div>

                    <div class='controls'><?php
                        echo CHtml::activeDropDownList($model, 'data_orientation', array(
                            'horizontal' => 'horizontal',
                            'vertical' => 'vertical',
                        ));
                        ?></div>
                    <?php echo $form->error($model, 'data_orientation'); ?>
                    <?php
                    if ('help.data_orientation' != $help = Yii::t('SlitSliderModule.crud', 'help.data_orientation')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>

                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <div class='control-label'><?php echo $form->labelEx($model, 'data_slice1_rotation'); ?></div>
                            <div class='controls'><?php echo $form->textField($model, 'data_slice1_rotation', array('size' => 5, 'maxlength' => 5, 'placeholder' => '-90 -> 90')); ?></div>
                            <?php echo $form->error($model, 'data_slice1_rotation'); ?>
                            <?php
                            if ('help.data_slice1_rotation' != $help = Yii::t('SlitSliderModule.crud', 'help.data_slice1_rotation')) {
                                echo "<span class='help-block'>{$help}</span>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <div class='control-label'><?php echo $form->labelEx($model, 'data_slice2_rotation'); ?></div>
                            <div class='controls'><?php echo $form->textField($model, 'data_slice2_rotation', array('size' => 5, 'maxlength' => 5, 'placeholder' => '-90 -> 90')); ?></div>
                            <?php echo $form->error($model, 'data_slice2_rotation'); ?>
                            <?php
                            if ('help.data_slice2_rotation' != $help = Yii::t('SlitSliderModule.crud', 'help.data_slice2_rotation')) {
                                echo "<span class='help-block'>{$help}</span>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <div class='control-label'><?php echo $form->labelEx($model, 'data_slice1_scale'); ?></div>
                            <div class='controls'><?php echo $form->textField($model, 'data_slice1_scale', array('size' => 5, 'maxlength' => 5, 'placeholder' => '0 - 10')); ?></div>
                            <?php echo $form->error($model, 'data_slice1_scale'); ?>
                            <?php
                            if ('help.data_slice1_scale' != $help = Yii::t('SlitSliderModule.crud', 'help.data_slice1_scale')) {
                                echo "<span class='help-block'>{$help}</span>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <div class='control-label'><?php echo $form->labelEx($model, 'data_slice2_scale'); ?></div>
                            <div class='controls'><?php echo $form->textField($model, 'data_slice2_scale', array('size' => 5, 'maxlength' => 5, 'placeholder' => '0 - 10')); ?></div>
                            <?php echo $form->error($model, 'data_slice2_scale'); ?>
                            <?php
                            if ('help.data_slice2_scale' != $help = Yii::t('SlitSliderModule.crud', 'help.data_slice2_scale')) {
                                echo "<span class='help-block'>{$help}</span>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main inputs -->
    </div>

    <div class="form-actions">

        <?php
        echo CHtml::Button(Yii::t('SlitSliderModule.crud', 'Cancel'), array(
            'submit' => (isset($_GET['returnUrl'])) ? $_GET['returnUrl'] : array('admin'),
            'class' => 'btn'
        ));
        echo ' ' . CHtml::submitButton(Yii::t('SlitSliderModule.crud', 'Save'), array(
            'class' => 'btn btn-primary'
        ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->
<script>
   
    if ($('#Slit_type').val() === 'html') {
        $('#slit_html').show();
        $('#slit_image').hide();
        $('#slit_image_assignment').hide();
    }
    else if ($('#Slit_type').val() === 'image') {
        $('#slit_html').hide();
        $('#slit_image').show();
        $('#slit_image_assignment').show();

    }

    jQuery('#Slit_type').on('change', function() {

        if (this.value === 'html') {
            $('#slit_image').hide();
            $('#slit_image_assignment').hide();
            $('#slit_html').show();
        }
        else if (this.value === 'image') {
            $('#slit_image').show();
            $('#slit_image_assignment').show();
            $('#slit_html').hide();
        }
    });
</script>