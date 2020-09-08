<?php
/**
 * Controller
 */
class Controller{
    
    public $request;            // Objet Request
    
    /**
     * Constructeur
     * @param $request Objet request de notre application
     */
    function __construct($request = null)
    { 
        
        $this->Session = new Session();
        $this->Form = new Form($this);
        if($request){
        $this->request = $request; // On stock la request dans l'instance
        require ROOT.DS.'config'.DS.'hook.php';
        }
    }

    /**
     * Permet de rendre une vue
     * @param $view Fichier à rendre (chemin depuis view ou nom de la vue)
     */
    public function render($view) {
        if($this->rendered) { return false; }
        extract($this->vars);
        if(strpos($view, '/')===0){
            $view = ROOT.DS.'view'.$view.'.php';
        } else {
            $view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
        }
        ob_start();
        require($view);
        $content_for_layout = ob_get_clean();
        require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
        $this->rendered = true;
    }
}