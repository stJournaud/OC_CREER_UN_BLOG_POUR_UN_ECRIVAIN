<?php
class Model{

    /**
	* Permet d'initialiser les variable du Model
	**/
    public function __construct(){
        

        
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