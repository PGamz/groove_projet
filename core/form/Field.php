<?php


namespace app\core\form;


use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER= 'number';
    public const TYPE_FILE= 'file';
    public const TYPE_DATE= 'date';
    public const TYPE_TIME= 'time';



    public string $for;
    public string $id;
    public string $type;
    public Model $model;
    public string $attribute;


    /**
     * Field constructor.
     * @param \app\core\Model $model
     * @param string $for
     * @param string $id
     * @param string $attribute
     */
    public function __construct(Model $model, string $for, string $attribute, string $id)
    {
        
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->for = $for;
        $this->id = $id;
    }

    public function __toString()
    {
        return sprintf('
            <div class="field">
                 <label for="%s">%s</label>
                 <input type="%s"  name="%s" value="%s" class="%s" id="%s" > 
                     
                 <div class="invalid">
                        %s   
                 </div>
            </div>
            
        ',
            $this->for,
            $this->model->getLabel($this->attribute),
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'invalid' : '',
            $this->id,
            $this->model->getFirstError($this->attribute)
        );
    }

    public function passwordField(): Field
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function file(): Field
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }

    public function date(): Field
    {
        $this->type = self::TYPE_DATE;
        return $this;
    }
    public function time(): Field
    {
        $this->type = self::TYPE_TIME;
        return $this;
    }


}