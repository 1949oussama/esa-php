<?php ob_start() ?>
<?php
session_start();

// Initialisation des variables de session nécessaires
if (!isset($_SESSION['chosenCategory'])) {
    $_SESSION['chosenCategory'] = null;
}
if (!isset($_SESSION['chosenWord'])) {
    $_SESSION['chosenWord'] = null;
}
if (!isset($_SESSION['guessedLetters'])) {
    $_SESSION['guessedLetters'] = [];
}
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

include 'dessin.php';

// Définition des catégories et mots possibles
$categories = [
    'Technologie' => ['ordinateur', 'programmation', 'internet', 'serveur', 'pendu', 'impression', 'smartphones', 'drones', 'hyperloop', 'telemedecine', 'eoliennes', 'piles', 'irm', 'blockchain'],
    'Animaux' => ['chien', 'chat', 'elephant', 'tigre', 'panda', 'kangourou', 'renard', 'tortue', 'serpent', 'cameleon', 'grenouille', 'salamandre', 'crapaud', 'coccinelle', 'papillon', 'sauterelle'],
    'Pays' => ['france', 'italie', 'espagne', 'allemagne', 'portugal', 'Australie', 'chili', 'argentine', 'bresil', 'mexique', 'canada', 'japon', 'chine', 'egypte', 'nigeria', 'ethiopie', 'zimbabwe']
];

// Choix de la catégorie et du mot
if (!isset($_SESSION['chosenCategory'])) {
    if (isset($_POST['category']) && array_key_exists($_POST['category'], $categories)) {
        $_SESSION['chosenCategory'] = $_POST['category'];
        $_SESSION['chosenWord'] = $categories[$_SESSION['chosenCategory']][array_rand($categories[$_SESSION['chosenCategory']])];
        $_SESSION['guessedLetters'] = [];
        $_SESSION['attempts'] = 0;
    }
} elseif (isset($_POST['letter'])) {
    $letter = strtolower($_POST['letter']);
    if (!in_array($letter, $_SESSION['guessedLetters'])) {
        $_SESSION['guessedLetters'][] = $letter;

        // Vérifiez si la lettre soumise est dans le mot choisi
        if (!in_array($letter, str_split($_SESSION['chosenWord']))) {
            $_SESSION['attempts']++; // Incrémente seulement si la lettre n'est pas dans le mot
        }
    }
}

// Réinitialisation ou fin de jeu
if (isset($_POST['reset']) || $_SESSION['attempts'] >= 10) {
    session_destroy();
    session_start();  // Recommencez une nouvelle session après la destruction
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Fonction pour afficher le formulaire de catégorie
function afficherFormulaireCategorie($categories) {
    echo '<form method="post" action="#">';
    echo '<select name="category">';
    foreach ($categories as $category => $words) {
        echo "<option value=\"$category\">$category</option>";
    }
    echo '</select>';
    echo '<input type="submit" value="Choisir la catégorie">';
    echo '</form>';
}

// Fonction pour obtenir le mot avec des tirets pour les lettres non devinées
function obtenirMotAffiche($word, $guessedLetters) {
    $display = '';
    if ($word !== null) { // Vérifiez si $word n'est pas null
        foreach (str_split($word) as $letter) {
            $display .= in_array($letter, $guessedLetters) ? $letter : '_';
            $display .= ' ';
        }
    }
    return $display;
}

// Vérifiez si le joueur a gagné
$motAffiche = obtenirMotAffiche($_SESSION['chosenWord'], $_SESSION['guessedLetters']);
if (!in_array('_', str_split($motAffiche)) && !empty($_SESSION['guessedLetters'])) {
    echo "<p>Bravo ! Vous avez deviné le mot !</p>";
    // Option pour réinitialiser le jeu
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu de Pendu</title>
    <style>
        body, html {
            height: 100%;
            margin: 0; 
            display: grid; 
            justify-content: center; 
            align-items: center; 
            font-family: Arial, sans-serif; 
        }
        form {
            width: 300px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(155,155,155,0.8);
            border-radius: 8px;
            display: grid; 
            align-items: center;
            background-color: #ffffff;
        }
        input, select {
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
   
    <?php if (isset($_SESSION['chosenCategory']) && $_SESSION['chosenWord'] !== null): ?>
        <h1>Jeu du Pendu</h1>
        <h3>Objectif</h3>
        <p>Deviner un mot inconnu en proposant des lettres.</p>
        <p>Deviner le mot avant que le dessin du pendu ne soit complété.</p>
        <h3>Catégorie choisie : <?= $_SESSION['chosenCategory']; ?></h3>
        <p>Mot à deviner : <?= $motAffiche = obtenirMotAffiche($_SESSION['chosenWord'], $_SESSION['guessedLetters']); ?></p>
        <p>Tentatives utilisées : <?= $_SESSION['attempts']; ?>/10</p>
        <form method="post" action="">
            <input type="text" name="letter" maxlength="1" required>
            <input type="submit" name="submit" value="Soumettre une lettre">
            <input type="submit" name="reset" value="Réinitialiser le jeu">
        </form>
        <?php
            if (!in_array('_', str_split($motAffiche)) && !empty($_SESSION['guessedLetters'])) {
                echo "<p>Bravo ! Vous avez deviné le mot !</p>";
            }
        ?>
    <?php else: ?>
        <h1>Jeu du Pendu</h1>
        <h3>Choisissez une catégorie:</h3>
        <?= afficherFormulaireCategorie($categories); ?>
    <?php endif; ?>

</body>
</html>
