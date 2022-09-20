<?php

require('./connection.php');
require('./conx.php'); //mettre mdp et user dans le fichier conx
require('./App/Models/Post.php');


use PALLAS\VPost\VPost;
use PALLAS\App\Models\Post;
use PALLAS\App\Models\Tagmm;

//$_POST['content'] = nl2br($_POST['content']);
//print_r($_POST);
$newpost = new VPost($conf);

$saisie = new Post($_POST);


$newpost->inserer('post', $saisie);

$tag_mm = [] ;
$res = $newpost->requete("SELECT * FROM post");
foreach ($res as $res_tab) {
    extract($res_tab);
    $tag_mm["id_post"] = $id;//ID du POST
}

foreach ($_POST['tags'] as $value){
    $tag_mm["id_tag"] = $value;
    $newpost->inserer('post_tag_mm',$tag_mm);
}

header('Location: listarticle.php');
