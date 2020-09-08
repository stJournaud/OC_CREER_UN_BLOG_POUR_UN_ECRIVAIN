<?php
class Router {

    /**
     * Permet de parser une url
     * @param $url Url à parser
     * @return tableau contenant les paramètres
     **/
    static function parse($url, $request) {
        $url = trim($url, '/');
        if(empty($url)) {
            $url = Router::$routes[0]['url'];
        } else {
            $match = false;
            foreach (Router::$routes as $v) {
                if(!$match && preg_match($v['redirreg'], $url, $match)){
                    $url = $v['origin'];
                    foreach ($match as $k=>$v) {
                        $url = str_replace(':'.$k.':',$v,$url);
                    }
                    $match = true;
                }
            }
        }
}