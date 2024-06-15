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
$todos = getTodos($username);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $taskIndex = $_POST['id'];
    if ($taskIndex !== '') {
        delete_task($username, $taskIndex);
        $_SESSION['message'] = 'Action éffectuée avec succès!';
        header('Location: ../index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TO DO LIST</title>
    <link rel="stylesheet" type="text/css" href="../Css/reset.css">
    <link rel="stylesheet" type="text/css" href="../Css/delete.css">
</head>
<body style="padding: 5% 20% 0 20%; text-align: center;">

    <div style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 5%;">
        <form action="delete.php" method="post">
            <div style="margin-bottom: 3%;">
                <label for="selectTache" style="padding-right: 3%;">Sélectionnez une tâche à supprimer:</label>
                <select id="selectTache" name="id"  style="padding: 2%;">
                    <option value="">--Sélectionner une tâche--</option>
                    <?php foreach ($todos as $index => $todo): ?>
                        <option value="<?php echo $index; ?>"><?php echo htmlspecialchars($todo['nom_tache']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div id="soumission" style="display: flex; justify-content: space-around; padding-top: 2%;">
                <div>
                    <input type="submit" name="submit" value="SUPPRIMER" class="style_bouton" style="border: none; width: 150%;box-sizing: border-box; padding: 10% 0 10% 0;">
                </div>
                <div>
                    <a href="../index.php" class="style_bouton" style="border: none; width: 150%;background-color: rgba(155, 155, 155, 0.2); padding: 10% 10% 10% 10%; text-decoration: none; color : black;">ANNULER</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
