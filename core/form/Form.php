<?php


namespace app\core\form;


use app\core\Model;

class Form
{
    public static function begin($action, $method, $enctype): Form
    {
        echo sprintf('<form action="%s" method="%s" enctype="%s">', $action, $method, $enctype);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $for, $attribute, $id): Field
    {
        return new Field($model, $for, $attribute, $id);
    }

    public function textArea(Model $model, $for, $attribute, $id): TextArea
    {
        return new TextArea($model, $for, $attribute, $id);
    }
}

    