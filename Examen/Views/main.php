<?php
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require_once '../Control/function.php';

	$username = $_SESSION['username'];
	$todos = getTodos($username);
	$filter = isset($_GET['filter']) ? $_GET['filter'] : 'tous';
	$sort = isset($_GET['sort']) ? $_GET['sort'] : 'none';
	$search = isset($_GET['search']) ? $_GET['search'] : '';
	$todos = filterTodos($todos, $filter);
	$todos = sortTodos($todos, $sort);
	$todos = searchTodos($todos, $search);

	// Lire la couleur de fond à partir du cookie
	$background_color = isset($_COOKIE['background_color']) ? $_COOKIE['background_color'] : '#ffffff';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TO DO LIST</title>
    <link rel="stylesheet" type="text/css" href="../Css/reset.css">
    <link rel="stylesheet" type="text/css" href="../Css/main.css">
    <style>
        body {
            background-color: <?php echo htmlspecialchars($background_color); ?>;
        }
    </style>
</head>
<body>

	<div id="color_picker">
        <form method="GET" action="../Layout/set_background_color.php">
            <label for="background_color">Choisissez une couleur de fond :</label>
            <input type="color" id="background_color" name="background_color" value="<?php echo htmlspecialchars($background_color); ?>">
            <input type="submit" value="Appliquer">

        </form>
    </div>
	<div id="first_div">
		<div>
			<h2>Statut</h2>
		</div>
		<div>
			<h2>Date de début</h2>
		</div>
		<div>
			<h2>Nom</h2>
		</div>
		<div>
			<h2>Catégorie</h2>
		</div>
		<div>
			<h2>Priorité</h2>
		</div>
		<div>
			<h2>Récurrence</h2>
		</div>
		<div>
			<h2>Date de création</h2>
		</div>
		<div>
			<h2>Description</h2>
		</div>
	</div>

	<div id="second_div">
        <?php if (empty($todos)): ?>
            <p style="text-align: center; padding: 2%;">Aucune tâche trouvée.</p>
        <?php else: ?>
            <?php foreach ($todos as $index => $todo): ?>
            <div class="task-container <?php echo ($todo['statut'] === 'realise') ? 'task-completed' : ''; ?>">
                <div><a href="../Layout/toggle.php?id=<?php echo $index; ?>" style="background-color: transparent; color: black;"><?php echo htmlspecialchars($todo['statut']); ?></a></div>
                <div><?php echo htmlspecialchars($todo['date_debut']); ?></div>
                <div><?php echo htmlspecialchars($todo['nom_tache']); ?></div>
                <div><?php echo htmlspecialchars($todo['categorie']); ?></div>
                <div><?php echo htmlspecialchars($todo['priorite']); ?></div>
                <div><?php echo htmlspecialchars($todo['recurrence']); ?></div>
                <div><?php echo htmlspecialchars($todo['date_creation']); ?></div>
                <div><?php echo htmlspecialchars($todo['description']); ?></div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
