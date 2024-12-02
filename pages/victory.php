<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['restart'])) {
    session_destroy();
    header("Location: ../index.php");
}

?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/victory.css">
    <title>Gagné !</title>
</head>

<body>
    <section>
        <h1>Lemmiwinks est sorti du labyrinthe , bravo Lemmiwinks ! </h1>
        <img src="../assets/img/victory.jpg" alt="photo victoire">
    </section>
    <form method="POST">
        <button name="restart" value="restart" class="restart">Recommencer</button>
    </form>

</body>

</html>