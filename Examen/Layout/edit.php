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
$selectedTask = null;
$taskIndex = null;

if (isset($_GET['task'])) {
    $taskIndex = $_GET['task'];
    $selectedTask = $todos[$taskIndex];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_index'])) {
    $taskIndex = $_POST['task_index'];
    $editedTask = [
        'nom_tache' => $_POST['nom_tache'],
        'categorie' => $_POST['categorie'],
        'priorite' => $_POST['priorite'],
        'statut' => $_POST['statut'],
        'recurrence' => $_POST['recurrence'],
        'date_debut' => $_POST['date_debut'],
        'date_creation' => $todos[$taskIndex]['date_creation'],
        'description' => $_POST['description']
        
    ];
    edit_task($username, $taskIndex, $editedTask);
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
    <link rel="stylesheet" type="text/css" href="../Css/edit.css">
</head>
<body>

<div>
    <form action="edit.php" method="GET">
        <div>
            <label for="task">Sélectionnez une tâche à éditer:</label>
            <select id="task" name="task" onchange="this.form.submit()">
                <option value="">--Sélectionner--</option>
                <?php foreach ($todos as $index => $todo): ?>
                    <option value="<?php echo $index; ?>" <?php if ($taskIndex == $index) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($todo['nom_tache']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>

<?php if ($selectedTask): ?>
    <div>
        <form action="edit.php" method="POST">
            <input type="hidden" name="task_index" value="<?php echo $taskIndex; ?>">
            <div>
                <div>
                    <label for="nom_tache">Nom de la tâche:</label>
                </div>
                <div>
                    <input type="text" id="nom_tache" name="nom_tache" value="<?php echo htmlspecialchars($selectedTask['nom_tache']); ?>" required>
                </div>
            </div>

            <div>
                <div>
                    <label for="categorie">Catégorie:</label>
                </div>
                <div>
                    <input type="text" id="categorie" name="categorie" value="<?php echo htmlspecialchars($selectedTask['categorie']); ?>" required>
                </div>
            </div>

            <div>
                <div>
                    <label for="priorite">Priorité:</label>
                </div>
                <div>
                    <select id="priorite" name="priorite" required>
                        <option value="basse" <?php if ($selectedTask['priorite'] == 'basse') echo 'selected'; ?>>Basse</option>
                        <option value="moyenne" <?php if ($selectedTask['priorite'] == 'moyenne') echo 'selected'; ?>>Moyenne</option>
                        <option value="haute" <?php if ($selectedTask['priorite'] == 'haute') echo 'selected'; ?>>Haute</option>
                    </select>
                </div>
            </div>

            <div>
                <div>
                    <label for="statut">Statut:</label>
                </div>
                <div>
                    <select id="statut" name="statut" required>
                        <option value="non_realise" <?php if ($selectedTask['statut'] == 'non_realise') echo 'selected'; ?>>Non Réalisé</option>
                        <option value="realise" <?php if ($selectedTask['statut'] == 'realise') echo 'selected'; ?>>Réalisé</option>
                    </select>
                </div>
            </div>

            <div>
                <div>
                    <label for="recurrence">Récurrence:</label>
                </div>
                <div>
                    <select id="recurrence" name="recurrence" required>
                        <option value="aucune" <?php if ($selectedTask['recurrence'] == 'aucune') echo 'selected'; ?>>Aucune</option>
                        <option value="quotidienne" <?php if ($selectedTask['recurrence'] == 'quotidienne') echo 'selected'; ?>>Quotidienne</option>
                        <option value="hebdomadaire" <?php if ($selectedTask['recurrence'] == 'hebdomadaire') echo 'selected'; ?>>Hebdomadaire</option>
                        <option value="mensuelle" <?php if ($selectedTask['recurrence'] == 'mensuelle') echo 'selected'; ?>>Mensuelle</option>
                    </select>
                </div>
            </div>

            <div>
                <div>
                    <label for="date_debut">Date et Heure de début:</label>
                </div>
                <div>
                    <input type="datetime-local" id="date_debut" name="date_debut" value="<?php echo htmlspecialchars($selectedTask['date_debut']); ?>" required>
                </div>
            </div>

            <div>
                <div>
                    <label for="description">Description:</label>
                </div>
                <div>
                   <textarea id="description" name="description"><?php echo htmlspecialchars($selectedTask['description']); ?></textarea> 
                </div>
            </div>

            <div id="soumission">
                <div>
                    <input type="submit" name="submit" value="EDITER" class="style_bouton">
                </div>
                <div>
                    <a href="../index.php" class="style_bouton">ANNULER</a>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

</body>
</html>
