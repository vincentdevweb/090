<?php
//print_r($_GET);
include('./connection.php');
include('./conx.php'); //mettre mdp et user dans le fichier conx

use PALLAS\VPost\VPost;

$id_post = $_GET['idpost'];
//print_r($id_post);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <?php include('./header.php'); ?>
    <div class="w-75 mx-auto">
        <div>
        <?php
            $updatepost = new VPost($conf);
            $requete = "SELECT * FROM post WHERE id=" . $id_post;
            $res = $updatepost->requete($requete, 'fetch');
            //echo print_r($res);
            echo $res['title'] . '<br>';
            echo $res['content'] . '<hr>';
            $requete2 = "SELECT * FROM comment WHERE post_id=" . $id_post;
            $res2 = $updatepost->requete($requete2);
            $requete3 = "SELECT * FROM user WHERE id=" . $res['author'];
            $res3 = $updatepost->requete($requete3, 'fetch');
            ?>
        </div>
        <form method="post" action="registercomment.php">
            <div class="mb-3">
                <label for="content" class="form-label">NEW COMMENTAIRE</label>
                <textarea class="form-control" id="content" name="content" type="text" required="required" rows="3"></textarea>
            </div>
            <input type="hidden" value="1" name="author">
            <input type="hidden" value='<?php echo time(); ?>' name="date_comment">
            <input type="hidden" value='<?php echo $id_post; ?>' name="post_id">
            <button type="submit" class="btn btn-success" value="Valider"> Valider le commentaire</button>
        </form>
        <div>
            <?php
            foreach ($res2 as $res2_tab) {
                foreach ($res2_tab as $key => $value) {
                    extract($res2_tab);
                    if ($key == 'author') {
                        echo $res3['firstname'] . ' ' . $res3['lastname'] . ' le : ' . date('d/m/Y', $date_comment);
                    }
                    if ($key == 'content') {
                        echo '<br>';
                        echo $value;
                        echo '<hr>';
                    }
                }
            }
            ?>
        </div>
    </div>
    <?php include('./footer.php'); ?>
</body>
<script src="./js/bootstrap.min.js"></script>

</html>