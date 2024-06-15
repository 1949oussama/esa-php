<?php
session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require 'function.php';

    // Vérifie si l'utilisateur est connecté
    if (!isset($_SESSION['username'])) {
        header('Location: connexion.php');
        exit();
    }
    $username = $_SESSION['username'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $task = [
            'nom_tache' => $_POST['nom_tache'],
            'categorie' => $_POST['categorie'],
            'priorite' => $_POST['priorite'],
            'statut' => $_POST['statut'],
            'recurrence' => $_POST['recurrence'],
            'date_debut' => $_POST['date_debut'],
            'date_creation' => date('Y-m-d H:i:s'),
            'description' => $_POST['description']
        ];
        add_task($username, $task);
        $_SESSION['message'] = 'Action éffectuée avec succès!';
        header('Location: ../index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TO DO LIST</title>
    <link rel="stylesheet" type="text/css" href="../Css/reset.css">
    <link rel="stylesheet" type="text/css" href="../Css/add.css">
</head>
<body>

	<div>
		<form action="add.php" method="POST">
			<div>
                <div>
                    <label for="nom_tache">Nom de la tâche:</label>
                </div>
                <div>
                    <input type="text" id="nom_tache" name="nom_tache" required>
                </div>
            </div>

            <div>
                <div>
                    <label for="categorie">Catégorie:</label>
                </div>
                <div>
                    <input type="text" id="categorie" name="categorie" required>
                </div>
            </div>

            <div>
                <div>
                    <label for="priorite">Priorité:</label>
                </div>
                <div>
                    <select id="priorite" name="priorite" required>
                        <option value="basse">Basse</option>
                        <option value="moyenne">Moyenne</option>
                        <option value="haute">Haute</option>
                    </select>
                </div>
            </div>

            <div>
                <div>
                    <label for="statut">Statut:</label>
                </div>
                <div>
                    <select id="statut" name="statut" required>
                        <option value="non_realise">Non Réalisé</option>
                    </select>
                </div>
            </div>

            <div>
                <div>
                    <label for="recurrence">Récurrence:</label>
                </div>
                <div>
                    <select id="recurrence" name="recurrence" required>
                        <option value="aucune">Aucune</option>
                        <option value="quotidienne">Quotidienne</option>
                        <option value="hebdomadaire">Hebdomadaire</option>
                        <option value="mensuelle">Mensuelle</option>
                    </select>
                </div>
            </div>

            <div>
                <div>
                    <label for="date_debut">Date et Heure de début:</label>
                </div>
                <div>
                    <input type="datetime-local" id="date_debut" name="date_debut" required>
                </div>
            </div>

            <div>
                <div>
                    <label for="description">Description:</label>
                </div>
                <div>
                   <textarea id="description" name="description"></textarea> 
                </div>
            </div>

            <div id="soumission">
            	<div>
            		<input type="submit" name="submit" value="AJOUTER" class="style_bouton">
            	</div>
            	<div>
            		<a href="../index.php" class="style_bouton">ANNULER</a>
            	</div>
            </div>
		</form>
	</div>
</body>
</html>