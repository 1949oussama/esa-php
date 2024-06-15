<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TO DO LIST</title>
    <link rel="stylesheet" type="text/css" href="Css/reset.css">
    <link rel="stylesheet" type="text/css" href="Css/style.css">
</head>
<body>
    <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='message'>".$_SESSION['message']."</div>";
            unset($_SESSION['message']);
        }

        include('Views/header.php');
        include('Layout/main.php');
        include('Views/footer.php');
    ?>
</body>
</html>
