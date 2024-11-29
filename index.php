<?php
include('./controller/move.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style/style.css">
    <title>Document</title>
</head>

<body>
    <?php displayArray($_SESSION["grille"]) ?>
    <form method="POST">
        <button name="direction" value="haut">Haut</button>
        <button name="direction" value="gauche">Gauche</button>
        <button name="direction" value="bas">Bas</button>
        <button name="direction" value="droite">Droite</button>
    </form>

    <form method="POST" >
        <button name="restart" value="restart">Recommencer</button>
    </form>
</body>
<source src="" type="audio/mpeg">
</html>