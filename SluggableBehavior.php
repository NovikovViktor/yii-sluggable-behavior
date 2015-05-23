<?php

/**
 * This behavior allow to automatically generate slug and place it to the model attribute
 *
 * Example of usage:
 * Append this code to `behaviors()` in model class
 * <pre>
 * 'sluggableBehavior' => array(
 *      'class'          => 'ext.yii-sluggable-behavior.SluggableBehavior',
 *      'delimiter'      => '-',
 *      'sluggable_attr' => 'title',
 *      'slug_attr'      => 'slug',
 *      'allow_update'   => true,
 * ),
 * </pre>
 */
class SluggableBehavior extends CActiveRecordBehavior
{
    /**
     * Delimiter for building slug string, default equal to `-`,
     * can be changed whe enable behavior.
     */
    public $delimiter = '-';

    /**
     * Holds name of model attribute that need to bee slugged
     */
    public $sluggable_attr;

    /**
     * Name of the model attribute what will represent slug
     */
    public $slug_attr;

    /**
     * Allow change slug attribute when update model
     */
    public $allow_update = false;

    /**
     * {@inheritdoc}
     */
    public function beforeSave()
    {
        if (!$this->allow_update && !$this->getOwner()->isNewRecord) {
            return;
        }
        $model = $this->getOwner();
        $attr = $this->sluggable_attr;
        $words = explode(' ', $model->$attr);
        foreach ($words as $key => $word) {
            $word = strtolower($word);
            $parsed = preg_replace('/[^A-Za-z0-9\-]/', '', $word);
            $words[$key] = $parsed;
            if (!$word || !$parsed) {
                unset($words[$key]);
            }
        }
        $slug = implode($this->delimiter, $words);
        $model->slug = $slug;
    }
}
