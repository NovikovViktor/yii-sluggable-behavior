<?php

class SluggableBehavior extends CActiveRecordBehavior
{
    public $delimiter;

    public $sluggable_attr;

    public $slug_attr;

    public function beforeSave()
    {
        $model = $this->getOwner();
        $attr = $this->sluggable_attr;
        $words = explode(' ', $model->$attr);
        $slug = implode($this->delimiter, $words);
        $model->slug = $slug;
    }
} 
