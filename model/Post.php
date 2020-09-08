<?php
class Post extends Model{
    /**
     * Permet de vérifier la validité des données
     */
    var $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'Vous devez préciser un titre'
        ),
        'slug' => array(
            'rule' => '([a-z0-9\-]+)',
            'message' => "L'Url n'est pas valide"
        ),
    );

}