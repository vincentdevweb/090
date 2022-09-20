<?php

include('./connection.php');
include('./conx.php');//mettre mdp et user dans le fichier conx

use PALLAS\VPost\VPost;

$_POST['content'] = nl2br($_POST['content']);
$saisie =  $_POST;
//$saisie['date_post'] = time();

$newpost = new VPost($conf);
$newpost->inserer('comment', $saisie);

// $saisie_keys =  array_keys($_POST) ;
// $saisie_value =  array_values($_POST) ;

//print_r($saisie);
header('Location: detail.php?idpost='.$saisie['post_id']);
