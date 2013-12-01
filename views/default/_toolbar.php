<?php Yii::beginProfile('SlitSlider.toolbar'); ?>

<?php
$showDeleteButton = (Yii::app()->request->getParam("id")) ? TRUE : FALSE;
$showManageButton = TRUE;
$showCreateButton = TRUE;
$showUpdateButton = TRUE;
$showCancelButton = TRUE;
$showSaveButton = TRUE;
$showViewButton = TRUE;

switch ($this->action->id) {
    case "admin":
        $showCancelButton = FALSE;
        $showSaveButton   = FALSE;
        $showViewButton   = FALSE;
        $showUpdateButton = FALSE;
        $showManageButton = FALSE;
        break;
    case "update":
        $showCreateButton = FALSE;
        $showUpdateButton = FALSE;
        break;
    case "create":
        $showCreateButton = FALSE;
        $showViewButton   = FALSE;
        $showUpdateButton = FALSE;
        break;
    case "view":
        $showViewButton   = FALSE;
        $showSaveButton   = FALSE;
        $showCreateButton = FALSE;
        break;
}
?>
<div class="clearfix">
    <div class="btn-toolbar pull-right">
        <div class="btn-group">
            <?php
            $this->widget("bootstrap.widgets.TbButton", array(
                "label"   => Yii::t("SlitSliderModule.crud", "Manage"),
                "icon"    => "icon-list-alt",
                "size"    => "large",
                "url"     => array("admin"),
                "visible" => $showManageButton && (Yii::app()->user->checkAccess("SlitSlider.Default.View") || Yii::app()->user->checkAccess("SlitSlider.Default.*"))
            ));
            ?>
        </div>
    </div>
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
            <?php
            $this->widget("bootstrap.widgets.TbButton", array(
                #"label"=>Yii::t("CrudModule.crud","Cancel"),
                "icon"        => "chevron-left",
                "size"        => "large",
                "url"         => (isset($_GET["returnUrl"])) ? $_GET["returnUrl"] : array("{$this->id}/admin"),
                "visible"     => $showCancelButton && (Yii::app()->user->checkAccess("SlitSlider.Default.View") || Yii::app()->user->checkAccess("SlitSlider.Default.*")),
                "htmlOptions" => array(
                    "class"       => "search-button",
                    "data-toggle" => "tooltip",
                    "title"       => Yii::t("SlitSliderModule.crud", "Cancel"),
                )
            ));
            $this->widget("bootstrap.widgets.TbButton", array(
                "label"   => Yii::t("SlitSliderModule.crud", "Create"),
                "icon"    => "icon-plus",
                "size"    => "large",
                "type"    => "success",
                "url"     => array("create"),
                "visible" => $showCreateButton && (Yii::app()->user->checkAccess("SlitSlider.Default.Create") || Yii::app()->user->checkAccess("SlitSlider.Default.*"))
            ));
            $this->widget("bootstrap.widgets.TbButton", array(
                "label"       => Yii::t("SlitSliderModule.crud", "Delete"),
                "type"        => "danger",
                "icon"        => "icon-trash icon-white",
                "size"        => "large",
                "htmlOptions" => array(
                    "submit"  => array("delete", "id" => $model->{$model->tableSchema->primaryKey}, "returnUrl" => (Yii::app()->request->getParam("returnUrl")) ? Yii::app()->request->getParam("returnUrl") : $this->createUrl("admin")),
                    "confirm" => Yii::t("SlitSliderModule.crud", "Do you want to delete this item?")
                ),
                "visible"     => $showDeleteButton && (Yii::app()->user->checkAccess("SlitSlider.Default.Delete") || Yii::app()->user->checkAccess("SlitSlider.Default.*"))
            ));
            $this->widget("bootstrap.widgets.TbButton", array(
                #"label"=>Yii::t("SlitSliderModule.crud","Update"),
                "icon"    => "icon-edit icon-white",
                "type"    => "primary",
                "size"    => "large",
                "url"     => array("update", "id" => $model->{$model->tableSchema->primaryKey}),
                "visible" => $showUpdateButton && (Yii::app()->user->checkAccess("SlitSlider.Default.Update") || Yii::app()->user->checkAccess("SlitSlider.Default.*"))
            ));
            $this->widget("bootstrap.widgets.TbButton", array(
                #"label"=>Yii::t("SlitSliderModule.crud","View"),
                "icon"        => "eye-open",
                "size"        => "large",
                "url"         => array("view", "id" => $model->{$model->tableSchema->primaryKey}),
                "visible"     => $showViewButton && (Yii::app()->user->checkAccess("SlitSlider.Default.View") || Yii::app()->user->checkAccess("SlitSlider.Default.*")),
                "htmlOptions" => array(
                    "data-toggle" => "tooltip",
                    "title"       => Yii::t("SlitSliderModule.crud", "View Mode"),
                )
            ));
            $this->widget("bootstrap.widgets.TbButton", array(
                "label"       => Yii::t("SlitSliderModule.crud", "Save"),
                "icon"        => "thumbs-up white",
                "size"        => "large",
                "type"        => "primary",
                "htmlOptions" => array(
                    "onclick" => "$('.crud-form form').submit();",
                ),
                "visible"     => $showSaveButton && (Yii::app()->user->checkAccess("SlitSlider.Default.View") || Yii::app()->user->checkAccess("SlitSlider.Default.*"))
            ));
            ?>
        </div>
        <?php if ($this->action->id == 'admin'): ?>
            <div class="btn-group">
                <?php
                $this->widget(
                    "bootstrap.widgets.TbButton",
                    array(
                        #"label"=>Yii::t("SlitSliderModule.crud","Search"),
                        "icon"        => "icon-search",
                        "size"        => "large",
                        "htmlOptions" => array(
                            "class"       => "search-button",
                            "data-toggle" => "tooltip",
                            "title"       => Yii::t("SlitSliderModule.crud", "Advanced Search"),
                        )
                    )
                );
                $this->widget(
                    "bootstrap.widgets.TbButton",
                    array(
                        #"label"=>Yii::t("SlitSliderModule.crud","Clear"),
                        "icon"        => "icon-remove-sign",
                        "size"        => "large",
                        "url"         => Yii::app()->baseURL . "/" . Yii::app()->request->getPathInfo(),
                        "htmlOptions" => array(
                            "data-toggle" => "tooltip",
                            "title"       => Yii::t("SlitSliderModule.crud", "Clear Search"),
                        )
                    )
                );?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if ($this->action->id == 'admin'): ?>
    <div class="search-form" style="display:none">
        <?php Yii::beginProfile('SlitSlider.toolbar.search'); ?>
        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>
        <?php Yii::endProfile('SlitSlider.toolbar.search'); ?>
    </div>
<?php endif; ?>
<?php Yii::endProfile('SlitSlider.toolbar'); ?>
