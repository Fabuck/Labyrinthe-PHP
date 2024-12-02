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
        } if($_SESSION['grille'][$newX][$newY] === "S"){
            header("Location: ./pages/victory.php");
        }
         else {
            echo '<audio autoplay>
            <source src="./assets/audio/audio.mp3" type="audio/mpeg">
          </audio>';
        }
    }
}



function displayArray($array)
{
    $posX = $_SESSION['posSouris'][0]["x"];
    $posY = $_SESSION['posSouris'][0]["y"];
    $radius = 1; // Rayon de visibilité autour du joueur

    foreach ($array as $rowIndex => $row) {
        echo ("<article>");
        foreach ($row as $colIndex => $cell) {
            // Vérifier si la case est dans le champ de vision
            if (abs($rowIndex - $posX) <= $radius && abs($colIndex - $posY) <= $radius) {
                // Affichez la case normalement
                if ($cell === 1) {
                    echo ("<div class='un'>" . "" . "</div>");
                } else if ($cell === 0) {
                    echo ("<div class='zero'>" . " " . "</div>");
                } else if ($cell === 'X') {
                    echo ("<img class='joueur' src='./assets/img/lemmiwinks.webp' ></img>");
                } else {
                    echo ("<img class='joueur' src='./assets/img/sacha.webp' ></img>");
                }
            } else {
                // Affichez une case masquée (brouillard)
                echo ("<div class='fog'>" . "" . "</div>");
            }
        }
        echo ("</article>");
    }
}

?>