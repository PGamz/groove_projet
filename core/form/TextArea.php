<?php


namespace app\core\form;


use app\core\Model;

class TextArea
{
    public const TYPE_TEXT = 'textarea';

    public string $type;
    public Model $model;
    public string $attribute;

    /**
     * Field constructor.
     * @param \app\core\Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('
            <div class="field" xmlns="http://www.w3.org/1999/html">
                 <label>%s</label>
                 <textarea class="%s"  name="%s" value="%s" class="%s"></textarea>     
                 <div class="invalid">
                        %s   
                 </div>
            </div>
            
        ',
     $this->model->getLabel($this->attribute),
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }




}