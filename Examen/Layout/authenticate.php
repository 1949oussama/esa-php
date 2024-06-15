<?php ob_start(); ?>
<?php
session_start();
include 'function.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authentifier($username, $password)) {
        // Enregistre le nom d'utilisateur dans la session
        $_SESSION['username'] = $username; 
        // Redirige vers la page principale 
        header("Location: ../index.php");  
        exit();
    } else {
        // Affiche un message d'erreur si les informations sont incorrectes
        echo "Invalid username or password.";
    }
}
?>
