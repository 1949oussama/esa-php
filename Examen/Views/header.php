<?php ob_start();
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../Control/function.php';

	if (!isset($_SESSION['username'])) {
	    header('Location: ../index.php');
	    exit();
	}

	$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TO DO LIST</title>
    <link rel="stylesheet" type="text/css" href="../Css/reset.css">
    <link rel="stylesheet" type="text/css" href="../Css/header.css">
</head>
<body>
	<header>
		<div id="header">
			<h1>TO DO LIST</h1>
        	<h2>Gérez vos tâches efficacement</h2>
        	<p>Bonjour <?php echo htmlspecialchars($username); ?>!</p>
		</div>

		<div>
			<nav>
				<ul id="premier_ul">
					<li>
						<img src="../Images/add.png" alt="Add" >
						<a href="../Layout/add.php">Ajouter une nouvelle tâche</a>
					</li>
					<li>
						<img src="../Images/edit.png" alt="Edit">
						<a href="../Layout/edit.php">Editer une tâche</a>
					</li>
					<li>
						<img src="../Images/delete.png" alt="../Delete">
						<a href="../Layout/delete.php">Supprimer une tâche</a>
					</li>
					<li class="dropdown">
						<img src="../Images/connexion.png" alt="img_connexion" id="img_connexion">
						<div class="dropdown-content">
							<a href="../Layout/logout.php">Se déconnecter</a>
							<a href="../Layout/update_password.php">Changer de mot de passe</a>
						</div>
					</li>
				</ul>

				<ul id="deuxieme_ul">
					<li>
						<form method="GET" action="../Views/page.php">
							<select name="sort" id="sort">
		                    <option value="none">---------Aucun-----------</option>
		                    <option value="tri_nom_asc">Nom (A-Z) </option>
		                    <option value="tri_nom_desc">Nom (Z-A) </option>
		                    <option value="tri_categorie_asc">Catégorie (A-Z) </option>
		                    <option value="tri_categorie_desc">Catégorie (Z-A) </option>
		                    <option value="tri_priorite_asc">Priorité (Basse-Moyenne-Haute) </option>
		                    <option value="tri_priorite_desc">Priorité (haute-Moyenne-Basse) </option>
		                    <option value="tri_date_debut_asc">Date de début (Récent-Ancien) </option>
		                    <option value="tri_date_debut_desc">Date de début (Ancien-Récent) </option>
		                    <option value="tri_date_creation_asc">Date de création (Récent-Ancien) </option>
		                    <option value="tri_date_creation_desc">Date de création (Ancien-Récent) </option>
		                </select>
		                <input type="submit" name="" value="Trier" class="input_header">
						</form>
					</li>

					<li>
						<form class="filter_form" method="GET" action="../Views/page.php">
							<select id="filter" name="filter">
		                    <option value="tous">--------Tous--------</option>
		                    <option value="realises">Réalisé</option>
            				<option value="non_realise">Non Réalisé</option>
		                </select>
		                <input type="submit"value="Filtrer" class="input_header">
						</form>
					</li>
                
	                <li>
	                	<form method="GET" action="../Views/page.php">
	                		<img src="../Images/search.png" alt="Add">
	                	<input type="text" name="search" placeholder="Rechercher une tache" id="input_search" class="input_header">
                		<input type="submit" value="Rechercher" class="input_header">
	                	</form>
	                </li>

        		<ul>
    		</nav>
		</div>
    </header>
</body>
</html>
