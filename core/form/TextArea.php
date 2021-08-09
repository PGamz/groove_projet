<?php


namespace app\core\form;


use app\core\Model;

class TextArea
{
    
    public string $for;
    public string $id;
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
        
        $this->model = $model;
        $this->attribute = $attribute;
        $this->for = $for;
        $this->id = $id;
    }

    public function __toString()
    {
        return sprintf('
            <div class="field" xmlns="http://www.w3.org/1999/html">
                 <label for="%s">%s</label>
                 <textarea  name="%s" value="%s" class="%s" id="%s"></textarea>     
                 <div class="invalid">
                        %s   
                 </div>
            </div>
            
        ',
            $this->for,
            $this->model->getLabel($this->attribute),
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'invalid' : '',
            $this->id,
            $this->model->getFirstError($this->attribute)
        );
    }




}