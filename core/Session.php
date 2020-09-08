<?php
class Session{
    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }


    /**
     * Permet de créer un message à afficher sur les pages
     */
    public function flash(){
        if(isset($_SESSION['flash']['message'])){
            $html = '<div class="alert '.$_SESSION['flash']['type'].'" role="alert"><p>'.$_SESSION['flash']['message'].'</p></div>';
            $_SESSION['flash'] = array();
            return $html;
        }
    }

    /**
     * Permet de rentrer les données à afficher dans le flash
     */
    public function setFlash($message,$type = 'success'){
        $_SESSION['flash'] = array(
            'message' => $message,
            'type' => $type
        );
    }

    /**
     * Permet d'écrire dans la session
     */
    public function write($key, $value) {
        $_SESSION[$key] = $value;
    }


    /**
     * Permet de lire les données en session
     */
    public function read($key = null){
        if($key) {
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            } else {
                return false;
            }
        } else {
            return $_SESSION;
        }
    }

    /**
     * Vérifie si le user est loggé
     */
    public function isLogged(){
        return isset($_SESSION['User']->id);
    }
}