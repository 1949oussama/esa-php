<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TO DO LIST</title>
    <link rel="stylesheet" type="text/css" href="../Css/reset.css">
    <link rel="stylesheet" type="text/css" href="../Css/style.css">
</head>
<body>
    <div class="message">
        <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            if (isset($_SESSION['message'])) {
                echo '<p>' . $_SESSION['message'] . '</p>';
                unset($_SESSION['message']);
            }
        ?>
    </div>
	<?php
        include('../Views/header.php');
        include('../Views/main.php');
    ?>
    <div class="footer">
        <?php
            include('../Views/footer.php');
        ?>
    </div>
</body>
</html>