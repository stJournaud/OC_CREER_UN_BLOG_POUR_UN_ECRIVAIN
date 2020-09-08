<?php
class Form{

    public $controller;
    public $errors;

    public function __construct($controller)
    {
        $this->controller = $controller;    
    }

    /**
     * Permet de créer les inputs d'un formulaire
     */
    public function input($name, $label, $options = array()){
        $error = false;
        $classError = '';
        if(isset($this->errors[$name])){
            $error = $this->errors[$name];
            $classError = ' is-invalid';
        }
        if(!isset($this->controller->request->data->$name)){
            $value = '';
        } else {
            $value = $this->controller->request->data->$name;
        }
        if($label == 'hidden'){
            return '<input type="hidden" name="'.$name.'" value="'.$value.'">';
        }
        $html = '<div class="form-group '.$classError.'">
                <label for="input'.$name.'">'.$label.'</label>
                <div class="input">';
        $attr = ' ';
        foreach ($options as $k => $v) {
            if($k != 'type'){
            $attr .= "$k=\"$v\"";
            }
        }
        if(!isset($options['type'])){
            $html .= '<input type="text" class="form-control '.(($error)?'is-invalid':'').'" id="input'.$name.'" name="'.$name.'" value="'.$value.'"'.$attr.'>';
        } elseif($options['type'] == 'textarea') {
            $html .= '<textarea id="input'.$name.'" name="'.$name.'" '.$attr.'>'.$value.'</textarea>';
        } elseif($options['type'] == 'checkbox') {
            $html .= '<div class="form-check"><input type="hidden" name="'.$name.'" value="0"><input type="checkbox" class="form-check-input" name="'.$name.'" value="1" '.(empty($value)?'':'checked').'/>
            <label class="form-check-label" for="'.$name.'"></div>';
        }  elseif($options['type'] == 'file') {
            $html .= '<input type="file" class="form-control-file '.(($error)?'is-invalid':'').'" id="input'.$name.'" name="'.$name.'"' .$attr.'>';
        }   elseif($options['type'] == 'password') {
            $html .= '<input type="password" class="form-control '.(($error)?'is-invalid':'').'" id="input'.$name.'" name="'.$name.'" '.$attr.'>';
        }
        if($error){
            $html .= '<div class="invalid-feedback">'.$error.'</div>';
        }

        $html .= '</div></div>';
        return $html;
    }
}