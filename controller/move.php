<?php
session_start();



if (!isset($_SESSION['posSouris'])) {
    $_SESSION['posSouris'] = [
        ["x" => 1, "y" => 1]
    ];
}

if (!isset($_SESSION['grille'])) {
    $_SESSION['grille'] = [
        [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
        [1, "X", 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1],
        [1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1],
        [1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 1],
        [1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1],
        [1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1],
        [1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1],
        [1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1],
        [1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1],
        [1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1],
        [1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1],
        [1, 1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1],
        [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
        [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1],
        [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, "S", 1],
    ];

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['restart'])) {
    
    session_destroy();
    header("Location: index.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $direction = isset($_POST['direction']) ? $_POST['direction'] : null;

    $deplacements = [
        'haut' => [-1, 0],
        'bas' => [1, 0],
        'gauche' => [0, -1],
        'droite' => [0, 1],
    ];

    if ($direction && isset($deplacements[$direction])) {
        $dx = $deplacements[$direction][0];
        $dy = $deplacements[$direction][1];
        $newX = $_SESSION['posSouris'][0]["x"] + $dx;
        $newY = $_SESSION['posSouris'][0]["y"] + $dy;

        if ($_SESSION['grille'][$newX][$newY] === 0) {
            $_SESSION['grille'][$_SESSION['posSouris'][0]["x"]][$_SESSION['posSouris'][0]["y"]] = 0;
            $_SESSION['posSouris'][0]["x"] = $newX;
            $_SESSION['posSouris'][0]["y"] = $newY;
            $_SESSION['grille'][$newX][$newY] = "X";
        } else {
            echo '<audio autoplay>
            <source src="./assets/audio/audio.mp3" type="audio/mpeg">
          </audio>';
        }
    }
}



function displayArray($array)
{
    foreach ($array as $row) {
        echo ("<article>");
        foreach ($row as $cell) {
            if ($cell === 1) {
                echo ("<div class='un'>" . "" . "</div>");
            } else if($cell === 0) {
                echo ("<div class='zero'>" . " ". "</div>");
            } else if  ($cell ==='X') {
                echo ("<img class='joueur' src='./assets/img/lemmiwinks.webp'  ></img>");
            } else {
                echo ("<img class='joueur' src='./assets/img/sacha.webp'  ></img>");

            }
        }
        echo ("</article>");
    }
}

?>