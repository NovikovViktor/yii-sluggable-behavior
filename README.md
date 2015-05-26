SluggableBehavior
==================================
SluggableBehavior - provide a simple tool for creations slugs, to make your app URL's beautiful, and

### Additions:

Do not forget to configure 'urlManager' component of your application.

### Basic usage:
1) Download the behavior;

``` bash
    git clone git@github.com:NovikovViktor/yii-sluggable-behavior.git
```

2) Add something like this into your model class:

``` php
public function behaviors()
{
    return array(
         'sluggableBehavior' => array(
             'class'          => 'path.to.behavior.SluggableBehavior',
             'delimiter'      => '-', // words delimiter
             'sluggable_attr' => 'name', // name of attr what need to be "slugged"
             'slug_attr'      => 'slug', // attr for store slug
             'allow_update'   => true, // allow update slug or not
             'length'         => 5, // length of words to place into slug
         ),
    );
}
```

4) Use slug attribute for build URL's.
