<?php
class Request{

    public $url;                // URL appellée par l'utilisateur

    function __construct() {
        $this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
        
        // Si on a une page dans l'url on la rentre dans $this->page
        if(isset($_GET['page'])){
            if(is_numeric($_GET['page'])) {
                if($_GET['page'] > 0){
                    $this->page = round($_GET['page']);
                }
            }
        }
        // Si des données ont été postées ont les entre dans data
        if(!empty($_POST)){
            $this->data = new stdClass();
            foreach ($_POST as $k => $v) {
                $this->data->$k=$v;
            }
        }
    }
}
