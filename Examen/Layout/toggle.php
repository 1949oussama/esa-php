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

if (isset($_GET['id'])) {
    $taskIndex = $_GET['id'];
    toggle_task_status($username, $taskIndex);
}

header('Location: ../index.php');
exit();
?>
