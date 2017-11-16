[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/NovikovViktor/yii-sluggable-behavior/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/NovikovViktor/yii-sluggable-behavior/?branch=master) [![Maintainability](https://api.codeclimate.com/v1/badges/1ff78b18b2d1763a6ced/maintainability)](https://codeclimate.com/github/NovikovViktor/yii-sluggable-behavior/maintainability)

SluggableBehavior
==================================
SluggableBehavior - is a simple tool for making your app URL's more readable.

Note: Do not forget to configure 'urlManager' component of your application.

### Basic usage:
1) Download the behavior to your project via git clone or manually as archive.

2) Configure your model class according to sample below:

``` php
public function behaviors()
{
    return array(
         'sluggableBehavior' => array(
             'class'          => 'path.to.behavior.SluggableBehavior',
             'delimiter'      => '-',    // words delimiter
             'sluggable_attr' => 'name', // name of attr what need to be "slugged"
             'slug_attr'      => 'slug', // attr for store slug
             'allow_update'   => true,   // allow update slug or not
             'length'         => 5,     // length of words to place into slug
         ),
    );
}
```

Now you are able to use slug attribute in your URLs.
