<?php

/**
 * This behavior allows automatically generate slug and store it to the model attribute.
 * It necessary for creating user-friendly URL's.
 *
 * Example of usage:
 * Append this code to `behaviors()` in model class
 * <pre>
 *      'sluggableBehavior' => array(
 *          'class'          => 'ext.yii-sluggable-behavior.SluggableBehavior',
 *          'delimiter'      => '-',    // words delimiter
 *          'sluggable_attr' => 'name', // name of attr what need to be "slugged"
 *          'slug_attr'      => 'slug', // attr for store slug
 *          'allow_update'   => true,   // allow update slug or not
 *          'length'         => 5,      // length of words to place into slug
 *      ),
 * </pre>
 */
class SluggableBehavior extends CActiveRecordBehavior
{
    /**
     * Delimiter for building slug string, default equal to `-`,
     * can be changed whe enable behavior.
     *
     * @var string
     */
    public $delimiter = '-';

    /**
     * Holds name of model attribute that need to bee slugged
     *
     * @var string
     */
    public $sluggable_attr;

    /**
     * Name of the model attribute what will represent slug
     *
     * @var string
     */
    public $slug_attr;

    /**
     * Allow change slug attribute when update model
     *
     * @var bool
     */
    public $allow_update = false;

    /**
     * Define length of slug, useful when title too long, and you want avoid bulky URL's
     *
     * @var integer
     */
    public $length;

    /**
     * {@inheritdoc}
     */
    public function beforeSave()
    {
        $model = $this->getOwner();

        if (!($this->allow_update && $model->isNewRecord)) { // check if we could update slug
            return;
        }

        $sluggable_attribute = $this->sluggable_attr;
        $slugWords           = explode(' ', $model->$sluggable_attribute);
        foreach ($slugWords as $key => $word) {
            $parsedWord  = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($word));
            $words[$key] = $parsedWord;
        }

        $slugWords = array_slice($slugWords, 0, $this->length);

        $model->$sluggable_attribute = implode($this->delimiter, $slugWords);
    }
}
