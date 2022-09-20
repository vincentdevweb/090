<?php

namespace SYRADEV\Database;

use PDO, PDOException;
use SYRADEV\Debug\dBug;

class PdoDb {
    private $conx;
    public function __construct($conf) {

        try {
            $this->conx = new PDO('mysql:host='.$conf['db']['host'].';dbname='.$conf['db']['database'], $conf['db']['user'], $conf['db']['password']);
        } catch(PDOException $e) {
            $message = 'Erreur ! ' . $e->getMessage() . '<hr />';
            die($message);
        }
    }

    public function requete($sql, $fetchMethod='fetchAll') {
        try {
            $result = $this->conx->query($sql, PDO::FETCH_ASSOC)->{$fetchMethod}();
        } catch(PDOException $e) {
            $message = 'Erreur ! ' . $e->getMessage() . '<hr />';
            die($message);
        }
        return $result;
    }

    public function inserer($table,$data) {
        // On convertit l'objet en tableau
        $dataTab = get_object_vars($data);
        // On récupère les nom de champs dans les clés du tableau
        $fields = array_keys($dataTab);
        // On récupère les valeurs
        $values = array_values($dataTab);
        // On compte le nombre de champ
        $values_count = count($values);
        $values_str = '';
        for($i=0;$i<$values_count;$i++) {
            $values_str .= ':p' . $i;
            if($i<$values_count-1) {
                $values_str .= ',';
            }
        }
        $reqInsert = 'INSERT INTO ' . $table . '('. implode(',',$fields).')';
        $reqInsert .= ' VALUES('.$values_str.')';
        $prepared = $this->conx->prepare($reqInsert);
        
        for($i=0;$i<$values_count;$i++) {
            switch(gettype($values[$i])) {
                case 'NULL':
                    $type = PDO::PARAM_NULL;
                    break;
                case 'integer':
                    $type = PDO::PARAM_INT;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
            $prepared->bindParam(':p'.$i, $values[$i],$type);
        }
        return $prepared->execute();
    }

    public function __destruct() {
        $this->conx = null;
    }

    // Retourne l'id de la dernière insertion par auto-incrément dans la base de données
    public function dernierIndex()
    {
        return $this->conx->lastInsertId();
    }
}