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

    echo $form->errorSummary($model);
    ?>
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
                            <div class='control-label'><?php echo $form->labelEx($model, 'start_date'); ?></div>
                            <div class='controls'><?php
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model' => $model,
                                    'attribute' => 'start_date',
                                    'language' => substr(Yii::app()->language, 0, strpos(Yii::app()->language, '_')),
                                    'htmlOptions' => array('size' => 20, 'readonly' => true, 'placeholder' => 'Choose...'),
                                    'options' => array(
                                        'showButtonPanel' => false,
                                        'disable' => true,
                                        'changeYear' => true,
                                        'changeYear' => true,
                                        'dateFormat' => 'yy-mm-dd',
                                    ),
                                        )
                                );
                                ;
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
                                    'html' => 'html',
                                    'image' => 'image',
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
                            <div class='control-label'><?php echo $form->labelEx($model, 'end_date'); ?></div>
                            <div class='controls'><?php
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model' => $model,
                                    'attribute' => 'end_date',
                                    'language' => substr(Yii::app()->language, 0, strpos(Yii::app()->language, '_')),
                                    'htmlOptions' => array('size' => 20, 'readonly' => true, 'placeholder' => 'Choose...'),
                                    'options' => array(
                                        'showButtonPanel' => false,
                                        'changeYear' => true,
                                        'changeYear' => true,
                                        'dateFormat' => 'yy-mm-dd',
                                    ),
                                        )
                                );
                                ;
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
                <h4><?php echo Yii::t('SlitSliderModule.crud', 'Input'); ?></h4>
                <div class="control-group">
                    <div class='control-label'><?php echo $form->labelEx($model, 'headline'); ?></div>
                    <div class='controls'><?php echo $form->textField($model, 'headline', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'Type: IMAGE')); ?></div>
                    <?php echo $form->error($model, 'headline'); ?>
                    <?php
                    if ('help.headline' != $help = Yii::t('SlitSliderModule.crud', 'help.headline')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>


                <div class="control-group">
                    <div class='control-label'><?php echo $form->labelEx($model, 'subline'); ?></div>
                    <div class='controls'><?php echo $form->textField($model, 'subline', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'Type: IMAGE')); ?></div>
                    <?php echo $form->error($model, 'subline'); ?>
                    <?php
                    if ('help.subline' != $help = Yii::t('SlitSliderModule.crud', 'help.subline')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>


                <div class="control-group">
                    <div class='control-label'><?php echo $form->labelEx($model, 'link'); ?></div>
                    <div class='controls'><?php echo $form->textField($model, 'link', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'Type: IMAGE')); ?></div>
                    <?php echo $form->error($model, 'link'); ?>
                    <?php
                    if ('help.link' != $help = Yii::t('SlitSliderModule.crud', 'help.link')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>

                <div class="control-group">
                    <div class='control-label'><?php echo $form->labelEx($model, 'bodyHtml'); ?></div>
                    <div class='controls'><?php echo $form->textArea($model, 'bodyHtml', array('rows' => 6, 'cols' => 60, 'placeholder' => 'Type: HTML')); ?></div>
                    <?php echo $form->error($model, 'bodyHtml'); ?>
                    <?php
                    if ('help.bodyHtml' != $help = Yii::t('SlitSliderModule.crud', 'help.bodyHtml')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>


                <div class="control-group">
                    <div class='control-label'><?php echo $form->labelEx($model, 'keywords'); ?></div>
                    <div class='controls'><?php echo $form->textField($model, 'keywords', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'Keyword1, Keyword2, Keyword3')); ?></div>
                    <?php echo $form->error($model, 'keywords'); ?>
                    <?php
                    if ('help.keywords' != $help = Yii::t('SlitSliderModule.crud', 'help.keywords')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>

                <hr>
                <h4><?php echo Yii::t('SlitSliderModule.crud', 'Assignment'); ?></h4>
                <div class="control-group">
                    <div class='control-label'><?php echo $form->labelEx($model, 'media_id'); ?></div>

                    <div class='controls'><?php $this->widget('p3media.components.P3MediaSelect', array('model' => $model, 'attribute' => 'page_id')); ?></div>
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
                        'label' => 'Top popover',
                        'type' => 'primary',
                        'htmlOptions' => array('data-title' => 'A Title', 'data-placement' => 'top', 'data-content' => 'And here\'s some amazing content. It\'s very engaging. right?', 'rel' => 'popover'),
                    ));
                    ?> 
                    <div class='controls'><?php echo $form->dropDownList($model, 'image_preset', SlitSliderWidget::getP3MediaPreset(), array('class' => 'span10', 'placeholder' => 'Choose Image Preset')); ?></div>
                    <?php echo $form->error($model, 'image_preset'); ?>
                    <?php
                    if ('help.image_preset' != $help = Yii::t('SlitSliderModule.crud', 'help.image_preset')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>


                <div class="control-group">
                    <div class='control-label'><?php echo $form->labelEx($model, 'page_id'); ?></div>
                    <div class='controls'><?php echo $form->dropDownList($model, 'page_id', SlitSliderWidget::getP3Pages(), array('class' => 'span10', 'placeholder' => 'Search Page Name')); ?></div>
                    <?php echo $form->error($model, 'page_id'); ?>
                    <?php
                    if ('help.page_id' != $help = Yii::t('SlitSliderModule.crud', 'help.page_id')) {
                        echo "<span class='help-block'>{$help}</span>";
                    }
                    ?>
                </div>


                <div class="control-group">
                    <div class='control-label'><?php echo $form->labelEx($model, 'rank'); ?></div>
                    <div class='controls'><?php echo $form->textField($model, 'rank', array('placeholder' => 'Position on this P3Page')); ?></div>
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