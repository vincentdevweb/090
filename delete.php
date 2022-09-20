<?php

include('./conx.php'); //mettre mdp et user dans le fichier conx
include('./connection.php');


use PALLAS\VPost\VPost;

$id_post = $_GET['idpost'];

$updatepost = new VPost($conf);


$updatepost->delete('post',$id_post);

header('Location: listarticle.php');