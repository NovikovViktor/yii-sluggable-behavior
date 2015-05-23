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
