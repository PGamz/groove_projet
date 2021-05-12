<?php


namespace app\core\form;


use app\core\Model;

class Form
{
    public static function begin($action, $method): Form
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute): Field
    {
        return new Field($model, $attribute);
    }

    public function textArea(Model $model, $attribute): TextArea
    {
        return new Textarea($model, $attribute);
    }
}

    