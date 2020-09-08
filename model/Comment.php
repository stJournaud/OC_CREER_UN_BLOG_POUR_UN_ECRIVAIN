<?php
class Comment extends Model{
    /**
     * Permet de vérifier la validité des données
     */
    var $validate = array(
        'author' => array(
            'rule' => 'notEmpty',
            'message' => 'Vous devez préciser un titre'
        ),
        'content' => array(
            'rule' => 'notEmpty',
            'message' => "Commentaire vide"
        ),
    );
}