<?php
// Fonction pour dessiner le pendu

// Définition des étapes du dessin du pendu
$etapes = [
    // Étape 0: Base de la potence
    "                          \n                          \n                          \n                          \n                          \n                         \n                          \n                          \n                          \n======================================",
    // Étape 1: Partie horizontale de la potence (doubles barres horizontales)
    "                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n======================================",
    // Étape 2: Partie verticale de la potence (doubles barres verticales)
    "     +-----------------+||\n                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n======================================",
    // Étape 3: Partie de la potence reliée à la tête
    "     +-----------------+||\n     |                  ||\n     |                  ||\n                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n======================================",
    // Étape 4: Ajout de la tête
    "     +-----------------+||\n     |                  ||\n     |                  ||\n     O                  ||\n                        ||\n                        ||\n                        ||\n                        ||\n                        ||\n======================================",
    // Étape 5: Ajout du corps
    "     +-----------------+||\n     |                  ||\n     |                  ||\n     O                  ||\n     |                  ||\n     |                  ||\n                        ||\n                        ||\n                        ||\n======================================",
    // Étape 6: Ajout d'un bras
    "     +-----------------+||\n     |                  ||\n     |                  ||\n     O                  ||\n    /|                  ||\n     |                  ||\n                        ||\n                        ||\n                        ||\n======================================",
    // Étape 7: Ajout du second bras
    "     +-----------------+||\n     |                  ||\n     |                  ||\n     O                  ||\n    /|\                 ||\n     |                  ||\n                        ||\n                        ||\n                        ||\n======================================",
    // Étape 8: Ajout d'une jambe
    "     +-----------------+||\n     |                  ||\n     |                  ||\n     O                  ||\n    /|\                 ||\n     |                  ||\n    /                   ||\n                        ||\n                        ||\n======================================",
    // Étape 9: Ajout de la deuxième jambe
    "     +-----------------+||\n     |                  ||\n     |                  ||\n     O                  ||\n    /|\                 ||\n     |                  ||\n    / \                 ||\n                        ||\n                        ||\n======================================",
];

function dessinerPendu($tentatives) {
    
    global $etapes; // Utilisez la variable $etapes à l'intérieur de la fonction

    if (is_array($etapes)) {
        // Vérifiez si le nombre de tentatives est inférieur au nombre total d'étapes
        if ($tentatives < count($etapes)) {
            echo "<pre style='font-size: 20px; line-height: 24px;'>" . $etapes[$tentatives] . "</pre>";
        } else {
            // Gérez le dépassement du nombre d'étapes si nécessaire
            echo "Nombre de tentatives dépassé!";
        }
    } else {
        // Gérez la situation où $etapes n'est pas un tableau
        echo "Erreur: Les étapes ne sont pas définies correctement!";
    }
}

// Appel à la fonction pour afficher le dessin actuel
if (isset($_SESSION['attempts'])) {
    // Vérifier si le nombre de tentatives est inférieur au nombre total d'étapes dans le tableau $etapes
    if ($_SESSION['attempts'] < count($etapes)) {
        dessinerPendu($_SESSION['attempts']);
    } else {
        // Si le nombre de tentatives dépasse le nombre total d'étapes, afficher un message d'erreur
        echo "Nombre de tentatives dépassé!";
    }
} else {
    echo "Erreur : L'état du jeu n'est pas correctement initialisé.";
}


?>