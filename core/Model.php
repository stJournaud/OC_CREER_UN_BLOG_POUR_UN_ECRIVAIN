<?php
class Model{

    static $connections = array();
    
    public $conf = 'default';
    public $table = false;
    public $db;
    public $primaryKey = 'id';
    public $id;
    public $errors = array();
    public $form;
    public $validate = array();
    /**
	* Permet d'initialiser les variable du Model
	**/
    public function __construct(){
    // Nom de la table
    if($this->table === false){
        $this->table = strtolower(get_class($this)).'s';
    }

    // Connection à la base ou récupération de la précédente connection
    $conf = Conf::$database[$this->conf];
    if(isset(Model::$connections[$this->conf])) { 
        $this->db = Model::$connections[$this->conf];
        return true; 
    }
    try{
        $pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
        $conf['login'],
        $conf['password'],
        array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        Model::$connections[$this->conf] = $pdo;
        $this->db = $pdo;
    }catch(PDOException $e) {
        if(Conf::$debug >= 1) {

        
        die($e->getMessage());
        } else {
        die('Impossible de se connecter à la base de données');
        } 
    }
            
    }


    /**
	* Permet de récupérer plusieurs enregistrements
	* @param $req Tableau contenant les éléments de la requête
	**/
    public function find($req){

        $sql = 'SELECT ';

        if(isset($req['fields'])) {
            if(is_array($req['fields'])) {
                $sql .= implode(', ', $$req['fields']);
            } else {
                $sql .= $req['fields'];
            }
        } else {
            $sql .= '*';
        }

        $sql .= ' FROM '.$this->table.' as '.get_class($this). ' ';

        // Construction de la condition
        if(isset($req['conditions'])) {
            $sql .= 'WHERE ';
            if(!is_array($req['conditions'])){
                $sql .= $req['conditions'];
            } else {
                $cond = array();
                foreach($req['conditions'] as $k=>$v){
                    if(!is_numeric($v)) {
                        $v = $this->db->quote($v);
                    }
                    $cond[] = "$k=$v";
                }
                $sql .= implode(' AND ', $cond);
            }
            
        }

        if(isset($req['order'])){
            $sql .= ' ORDER BY '.$req['order'];
        }

        if(isset($req['limit'])) {
            $sql .= ' LIMIT '.$req['limit'];
        }
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_OBJ);
        
    }

}