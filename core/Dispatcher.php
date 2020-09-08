<?php
/**
* Dispatcher
* Permet de charger le controller en fonction de la requête utilisateur
**/
class Dispatcher{
    
    var $request;   // Object Request

    /**
	* Fonction principale du dispatcher
	* Charge le controller en fonction du routing
	**/
    function __construct() {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();

        call_user_func_array(array($controller, $action),$this->request->params);
    }

    /**
	* Permet de charger le controller en fonction de la requête utilisateur
	**/
    function loadController(){
        $name = ucfirst($this->request->controller).'Controller';
        $file = ROOT.DS.'controller'.DS.$name.'.php';
        if(!file_exists($file)){
            $this->error('Le controller '. $this->request->controller. ' n\'existe pas');
        }
        require $file;
        $controller = new $name($this->request);
        

        return $controller;
    }
}