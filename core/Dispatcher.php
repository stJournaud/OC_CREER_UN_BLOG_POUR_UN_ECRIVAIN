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
    }
}