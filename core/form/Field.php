<?php


namespace app\core\form;


use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER= 'number';
    public const TYPE_FILE= 'file';




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
            <div class="field">
                 <label>%s</label>
                 <input type="%s"  name="%s" value="%s" class="%s"> 
                     
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

    public function passwordField(): Field
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function fileField(): Field
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }



}