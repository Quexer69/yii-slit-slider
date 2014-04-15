Yii Slit Slider Widget
=============

**Version 0.3.9-patch1**


What is Slit Slider Widget?
=============

A phundament3 Widget from the well known jQuery Slit Slider.
But we have a backend crud to administrate all the slider widgets in your web application.
*featuring P3Media*

Composer support for easy installation of this phundament3 widget.

 * [phundament3 on GitHub]      (https://github.com/phundament/app)
 * [p3Media on GitHub]          (https://github.com/schmunk42/p3media)
 * [yii-slit-slider on GitHub]  (https://github.com/quexer69/yii-slit-slider)


Quick-Start
=============

### Composer
If you have [composer already installed](http://getcomposer.org/doc/00-intro.md#installation-nix)

`composer.phar require quexer69/yii-slit-slider`

**or**

add the package `quexer69/yii-slit-slider` to your composer.json


*!!! You need to have already setup a database connection for the yii-slit-slider migration !!!*


Setup
=============
[SETUP] edit in app/config/main.php

**REQUIRED**
```php
'modules' => array(
        'slitSlider' => array(
            'class' => 'vendor.quexer69.yii-slit-slider.SlitSliderModule',
            'imagePresets' => array(
                'slitSlider-crop-16-9-jpg' => 'Picture 16:9 cropped 2000x700px (JPG)',
                'slitSlider-crop-16-9-png' => 'Picture 16:9 cropped 2000x700px (PNG)',
            ),
        ),
        ...
        'p3media' => array(
            'class' => 'vendor.phundament.p3media.P3MediaModule',
            'params' => array(
                ...
                'presets' => array(
                    ...
                    'slitSlider-crop-16-9-jpg' => array(
                            'name' => 'Picture 16:9 cropped 2000x700px (JPG)',
                            'commands' => array(
                                'resize' => array(2000, 700, 7), // crop
                                'quality' => '85',
                            ),
                            'type' => 'jpg',
                    ),
                    'slitSlider-crop-16-9-png' => array(
                            'name' => 'Picture 16:9 cropped 2000x700px (PNG)',
                            'commands' => array(
                                'resize' => array(2000, 700, 7), // crop
                                'quality' => '85',
                            ),
                            'type' => 'png',
                    ),
                    ...
                ),
            ),
        ),
```
*do add imagePresets to the slitslider module. The indices of this array have to be real p3media->params->presets!*


edit in app/config/console.php to add slit-slider migration ($ yiic migrate)

**REQUIRED**
```php
'migrate' => array(
        'modulePaths' => array(
            ...
            'slitSlider' => 'vendor.quexer69.yii-slit-slider.migrations',
            ...
            ),
        ),
```

**OPTIONAL** *(if you have schmunk42/multi-theme installed, you can say in which theme should the SlitSlider Backend be displayed)*
```php
'themeManager' => array(
            'class' => 'vendor.schmunk42.multi-theme.EMultiThemeManager',
            'basePath' => $applicationDirectory . '/themes',
            'baseUrl' => $baseUrl . '/themes',
            'rules' => array(
                ...
                '^slitSlider/(.*)' => 'backend2',
                ...
            )
        ),
```

Run widget
=============

**Default Call of the slitSlider Widget**
```php

    $this->widget('slitSlider.components.SlitSliderWidget');

```

**Params Call of the slitSlider Widget**
```php

    $this->widget(
       'vendor.quexer69.yii-slit-slider.SlitSliderWidget',
           array(
               'orientation'   => 'horizontal',    // default orientation if slit has no orientation set
               'imagePreset'   => 'slitslider',    // P3Media image preset for pictures
               'order'         => 'rank DESC',     // sort order of the slits
               'scaleable'     => '1',             // responsive or defined height and width
               'groupId'       => NULL,            // show all slits for a group_id
               'max_width'     => '2000px',        // needed for scalabel = 1 (true)
               'width'         => '100%',          // css width of the wrapper
               'height'        => '500px',         // can be set on scalabel = 0 (false)
           )
    );

```
* `if groupId is NULL for a slider widget` -> all slits will be shown in this slider.
* `if groupId is NULL for a slit` -> this slit will be shown in all sliders.
* `groupId` can be a number or a groupname


**Or easily add through P3WidgetContainer**

*(you need to add slitSlider Widget to the P3Widgets)*
```php
'p3widgets' => array(
        'params' => array(
            'widgets' => array(
                ...
                'slitSlider.components.SlitSliderWidget' => 'SlitSlider'
        ),
        ...
```
*output on any page template*
```php
    $this->widget('p3widgets.components.P3WidgetContainer',
        array(
            'id' => 'slitSlider',
            'varyByRequestParam' => P3Page::PAGE_ID_KEY
        )
    );
```


Administration
=============
Now you get in the P3Admin backend the module SlitSlider to configurate your sliders!!!


Custom Attributes
=============

Every slide will also have some data-attributes that we will use in order to control the effect for each slide.
The data attributes that we want are the following:

```
data-orientation
data-slice1-rotation
data-slice2-rotation
data-slice1-scale
data-slice2-scale
```

The first one, `data-orientation` should be either `vertical` or `horizontal`.
This we need in order to know where to “slice” the slide. It will be either slice horizontally or vertically.
The `data-slice1-rotation` and `data-slice2-rotation` value will be the **rotation degree** for each one of the slices
and the `data-slice1-scale` and `data-slice2-scale` value will be the **scale value**.

Documentation
=============

 * [The Definitive Guide to Phundament](https://github.com/phundament/app/wiki)


Database-Dump
=============

dump Schema
---
     app/yiic database dump init_slitSlider_tables --prefix=slider_ \
     --dbConnection=db --createSchema=1 \
     --insertData=0

dump datas
---
     app/yiic database dump replace_slider_data --prefix=slider_ \
     --dbConnection=db --createSchema=0 \
     --foreignKeyChecks=0 --truncateTable=1
