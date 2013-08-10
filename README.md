Yii Slit Slider 
==========

**Version 0.1.0**


What is Slit Slider?
=============

Using jQuery and CSS animations we can create unique slide transitions for the content elements.

We have a backend to administrate all the sliders in your webapplication.

*Featured by P3Pages and P3Media*

A lot of changes were integrated into the new Slit Slider, here are the most important ones:

    *The slider can now be used in a responsive context, simply set the wrapper’s width to a percentage and it will adapt.
    *The Transit plugin was removed.
    *We’ve added public methods for navigation control: next, previous and specific slide. This will make it possible to use custom controls.
    *Keyboard navigation has been added (right and left arrow keys).
    *The Firefox bug has been fixed.
    *We’ve added callback functions for before and after each slide transition.
    *New method for dynamically adding new slides.
    *Some other bug fixes, like flickering etc.

(https://github.com/quexer69/yii-slit-slider)


Quick-Start
=============

### Step 1
If you have [composer already installed](http://getcomposer.org/doc/00-intro.md#installation-nix)
   
`composer.phar require `quexer69/yii-slit-slider`

**or**

add the package `quexer69/yii-slit-slider` to your composer.json


*!!! You need to have already setup a database connection for the yii-slit-slider migration !!!*

### Step 2  
[SETUP] edit in app/config/main.php

**REQUIRED**
```php
'modules' => array(
        'slitSlider' => array(
            'class' => 'vendor.quexer69.yii-slit-slider.SlitSliderModule',
        ),
```

[SETUP] edit in app/config/console.php to add slit-slider migration ($ yiic migrate)

**REQUIRED**
```php
'migrate' => array(
        'modulePaths' => array(
            ...
            'slitSlider'            => 'vendor.quexer69.yii-slit-slider.SlitSliderModule.migrations',
            ...
            ),
        ),
```


Documentation
=============

 * [The Definitive Guide to Phundament](https://github.com/phundament/app/wiki)


Database-Dump
=============

     app/yiic database dump replace_slider_data --prefix=slider_ \
     --dbConnection=db --createSchema=0 \
     --foreignKeyChecks=0 --truncateTable=1
