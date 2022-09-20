<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./App/choices/choices.min.css">
</head>

<body>

    <form method="post">

    <select name="tags[]" id="tags" multiple>
            <option value="1">#JavaScript</option>
            <option value="2">#PHP</option>
            <option value="3">#PHP8.1</option>
            </select>

        <button type="submit">Poster</button>

    </form>
    <script src="./App/choices/choices.min.js"></script>
    <script>
        const tagChoice = new Choices(document.querySelector('#tags'), {
            removeItems: true,
            removeItemButton: true,
            plceholderValue: "veuillez sélectionner un tag",
            itemSelected: "coucou"
        });
    </script>
</body>

</html>