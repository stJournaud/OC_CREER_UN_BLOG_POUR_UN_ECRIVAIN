<?php
class Request{

    public $url;                // URL appellée par l'utilisateur

    function __construct() {
        $this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

            }
        }
