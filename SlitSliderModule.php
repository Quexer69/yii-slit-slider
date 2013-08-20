<?php
/**
 * Class File
 * @author    Christopher Stebe <chris@stebe.eu>
 * @link      https://github.com/Quexer69
 * @copyright Copyright &copy; 2005-2010 diemeisterei GmbH
 * @license   http://www.phundament.com/license/
 */
// Set alias for slitslider assets
Yii::setPathOfAlias('SlitAssets', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR));

class SlitSliderModule extends CWebModule
{
    
    public $imagePresets = array();

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        
        // import the module-level models and components
        $this->setImport(array(
            'slitSlider.models.*',
            'slitSlider.components.*',
            'vendor.phundament.p3media.models.*'
        ));
        
        // Register some JS Code for features used in Crud
        $jsSnipp = "jQuery('body').popover({'selector':'[rel=popover]'});";
        $registerScripts = Yii::app()->getClientScript();
        $registerScripts->registerScript('Yii.features' . 'slitSlider', $jsSnipp);
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

}
