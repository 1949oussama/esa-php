<?php ob_start(); ?>
<?php
	session_start();
	// Supprime toutes les variables de session
	session_unset();
	// Détruit la session en cours  
	session_destroy();
	// Redirige vers la page de connexion  
	header("Location: connexion.php");  
	exit();
?>
