<?php

namespace PALLAS\VPost;

use PDO, PDOException;

class VPost
{
    private $dbh;
    public function __construct($conf)
    {
        try {
            $this->dbh = new PDO('mysql:host=' . $conf['db']['host'] . ';dbname=' . $conf['db']['database'], $conf['db']['user'], $conf['db']['password']);
        } catch (PDOException $e) {
            $message = 'ERREUR !!!' . $e->getMessage() . '<hr /r>';
            die($message);
        }
    }

    public function requete($sql, $fetchMetodo = 'fetchALL')
    {
        try {
            $resultat = $this->dbh->query($sql, PDO::FETCH_ASSOC)->{$fetchMetodo}();
        } catch (PDOException $e) {
            $message = 'ERREUR !!!' . $e->getMessage() . '<hr /r>';
            die($message);
        }
        return $resultat;
    }



    public function inserer(string $methode, $NwPoste)
    {
        $NwPoste_O = get_object_vars($NwPoste);
        $newposttab_keys = array_keys($NwPoste_O);
        $newposttab_values = array_values($NwPoste_O);

        $tab_keys = implode(',', $newposttab_keys);
        $tabvide = implode(',', array_fill(0, count($NwPoste_O), '?'));

        $requete = 'INSERT INTO ' . $methode . ' (' . $tab_keys . ') VALUES (' . $tabvide . ')';

        //echo $requete;
        $preparation = $this->dbh->prepare($requete);
        $preparation->execute($newposttab_values);

        return $preparation; // renvoi TRUE OR FALSE
        //echo $preparation;
        //return $requete;
    }

    public function inserer2(String $table, $data) {
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


    public function delete($methode, $id_number)
    {

        $requete = 'DELETE FROM `' . $methode . '` WHERE `' . $methode . '`.`id` = :id_number ';
        echo $requete;
        //echo $requete;
        $preparation = $this->dbh->prepare($requete);
        $preparation->bindParam(':id_number', $id_number, PDO::PARAM_INT);
        $preparation->execute();

        // return $preparation;
        //echo $preparation;
        //return $requete;
    }
}
