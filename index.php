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
    <section>
        <?php displayArray($_SESSION["grille"]) ?>
    </section>
    <form method="POST">
        <div class="fleches">
            <button name="direction" value="haut">↑</button>
            <div class="gaucheDroite">
                <button name="direction" value="gauche">←</button>
                <button name="direction" value="droite">→</button>
            </div>
            <button name="direction" value="bas">↓</button>
        </div>
    </form>
    <form method="POST">
        <button name="restart" value="restart" class="restart" >Recommencer</button>
    </form>
</body>
<source src="" type="audio/mpeg">

</html>