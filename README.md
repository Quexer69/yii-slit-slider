Yii Slit Slider Widget
=============

**Version 0.1.0**


What is Slit Slider Widget?
=============

A phundament3 Widget from the well known jQuery Slit Slider.
But we have one backend crud to administrate all the slider widgets in your webapplication.
*featuring P3Pages and P3Media*

Composer support for easy installation of this phundament3 widget.

 * [phundament3 on GitHub]      (https://github.com/phundament/app)
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
        ),
        ...
```


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

Run widget
=============

**Default Call of the slitSlider Widget**
```php

    $this->widget('slitSlider.components.SlitSliderWidget'); 

```

**Params Call of the slitSlider Widget**
```php

    $this->widget('slitSlider.components.SlitSliderWidget', 
            array(
                'orientation'   => 'horizontal',    // default orientation if slit has no orientation set
                'image_preset'  => 'slitslider',    // P3Media image preset for pictures
                'order'         => 'rank DESC',     // sort order of the slits
                'pageId'        => '5',             // show all slits for a P3Page->id
                'height'        => '600px',         // css height of the wrapper
                'width'         => '100%'           // css width of the wrapper
            )
    );

```

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
*output on any p3page template*
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
