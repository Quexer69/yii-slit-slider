<?php

/**
 * Class File
 * @author    Christopher Stebe <chris@stebe.eu>
 * @link      https://github.com/Quexer69/yii-slit-slider
 * @copyright Copyright &copy; 2013 Christopher Stebe
 *
 *  Call this Widget on which page and position
 *  you what the slit-slider appear.
 *  With group ID's you can manage multiple sliders in your web application
 * 
 * <pre>
 * <?php
 *   $this->widget(
 *      'vendor.quexer69.yii-slit-slider.widgets.MeridaSlitSliderWidget', 
 *          array(
 *              'orientation'   => 'horizontal',
 *              'image_preset'  => 'slitslider',
 *              'order'         => 'rank DESC',
 *              'groupId'       => NULL,
 *              'width'         => '100%',
 *              'height'        => '500px',
 *          )
 *   );
 * ?>
 * </pre>
 * {@link SlitController}
 * @author  Christopher Stebe <chris@stebe.eu>
 * @version 0.2.0
 * @package quexer69/yii-slit-slider
 */
class MeridaSlitSliderWidget extends SlitSliderWidget
{
    
    /**
     * run Merida slit slider widget
     */
    public function run()
    {
        // @var $groupID: Get group_id
        $groupID = parent::groupId;

        // get Slit models for this P3Page and status
        $thisSlits = parent::querySlits($groupID);

        // Check if slits are availible for this P3age
        if (parent::hasSlits($thisSlits)) {

            // Just if there are slits for this P3Page, publish Assets (css, js)
            parent::registerAssets($thisSlits);

            // Output HTML Template (for IMAGE and HTML slits)
            parent::openSliderWrapper();

            foreach ($thisSlits as $slit) {

                // if slit type -> image
                if ($slit->type === self::IMAGE) {
                    self::showImage($slit);
                }
                // if slit type -> html
                elseif ($slit->type === self::HTML) {
                    self::showHtml($slit);
                }
            }
            // put needed dots to navigate, first has class 'nav-dot-current'
            parent::showDots($thisSlits);

            parent::closeSliderWrapper();
        }
    }
    
    /**
     * 
     * @param type $model
     */
    private function showImage($model)
    {
        // Create image URL, check if media_preset for image is in config/main availible
        $imgSrc = Yii::app()->controller->createUrl('/p3media/file/image', array(
            'id' => $model->media_id,
            'preset' => (isset($model->image_preset) && in_array($model->image_preset, self::getP3MediaPresetNames())) ? $model->image_preset : $this->image_preset));

        $thisDataOrientation = (isset($model->data_orientation)) ? $model->data_orientation : $this->orientation;

        echo "      <div class=\"sl-slide\" 
                            data-orientation=\"$thisDataOrientation\" 
                            data-slice1-rotation=\"$model->data_slice1_rotation\" 
                            data-slice2-rotation=\"$model->data_slice2_rotation\" 
                            data-slice1-scale=\"$model->data_slice1_scale\" 
                            data-slice2-scale=\"$model->data_slice2_scale\">\n";

        echo "          <div class=\"sl-slide-inner\">\n";
        echo "              <div class=\"bg-img centerHtml\">\n";
        echo "                  <img src=\"{$imgSrc}\" alt=\"\" />";
        echo "              </div>\n";
        echo "                    <h2>{$model->headline}</h2>\n";
        echo "                    <blockquote>\n";
        echo "                        <p>{$model->subline}</p>\n";
        if ($model->link !== NULL) {
            echo "<a class=\"btn btn-theme\" href=\"{$model->link}\" target=\"_blank\"><i class=\"icon-external-link\"></i>mehr</a>";
        }
        echo "</blockquote>\n";
        echo "          </div>\n";
        echo "      </div>\n";
    }

    /**
     * 
     * @param type $model
     */
    private function showHtml($model)
    {
        echo "      <div class=\"sl-slide\" 
                            data_orientation=\"$model->data_orientation\" 
                            data_slice1_rotation=\"$model->data_slice1_rotation\" 
                            data_slice2_rotation=\"$model->data_slice2_rotation\" 
                            data_slice1_scale=\"$model->data_slice1_scale\" 
                            data_slice2_scale=\"$model->data_slice2_scale\">\n";

        echo "          <div class=\"sl-slide-inner\">\n";
        echo "              <div class=\"centerHtml\">\n";
        echo $model->bodyHtml;
        echo "              </div>\n";
        echo "          </div>\n";
        echo "      </div>\n";
    }
}

?>