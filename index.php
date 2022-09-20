<?php include('./connection.php');
include('./conx.php'); //mettre mdp et user dans le fichier conx

use PALLAS\VPost\VPost; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./App/choices/choices.min.css">
    <title>Document</title>
</head>

<body>
    <?php include('./header.php'); ?>
    <div class="card">
        <h5 class="card-header text-center mb-3">NEW POST</h5>
        <div class="w-75 mx-auto card-body">
            <form method="post" action="registerpost.php">
                <div class="mb-3">
                    <label for="title" class="form-label">TITRE</label>
                    <input id="title" name="title" type="text" class="form-control" required="required" placeholder="example de titre">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">DESCRIPTION</label>
                    <textarea class="form-control" id="content" name="content" type="text" required="required" rows="3"></textarea>
                </div>
                <input type="hidden" value="1" name="author">
                <input type="hidden" value="1" name="blog_id">
                <input type="hidden" value='<?php echo time(); ?>' name="date_post">
                <div>
                    <label for="tags[]" class="form-label">Selected TAGS</label>
                    <select name="tags[]" id="tags" multiple>
                        <?php
                        $updatepost = new VPost($conf);
                        $requete = "SELECT * FROM tag";
                        $res = $updatepost->requete($requete);
                        foreach ($res as $res_tab) {
                            extract($res_tab);
                            echo "<option value='" . $id . "'>" . $name . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="tags[]" class="form-label">Add New Name TAG</label>
                </div>
                <button type="submit" class="btn btn-success" value="Valider" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tooltip on bottom"> Valider le formulaire</button>
            </form>
        </div>
    </div>
    <?php include('./footer.php'); ?>
</body>
<script src="./js/bootstrap.min.js"></script>
<script src="./App/choices/choices.min.js"></script>
<script>
    const tagChoice = new Choices(document.querySelector('#tags'), {
        removeItems: true,
        removeItemButton: true,
        plceholderValue: "veuillez sélectionner un tag",
        itemSelected: "coucou"
    });
</script>

</html>