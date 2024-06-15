<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TO DO LIST</title>
    <link rel="stylesheet" type="text/css" href="../Css/reset.css">
    <link rel="stylesheet" type="text/css" href="../Css/style_connexion.css">
</head>
<body>

	<?php
        session_start();
        require_once('function.php');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['id_connexion'];
            $new_password = $_POST['new_password'];

            if (update_password($username, $new_password)) {
                $message = "Mot de passe mis à jour avec succès.";
            } else {
                $error = "Utilisateur non trouvé.";
            }
        }
    ?>

    <div id="head_connexion">
        <h1>USER LOGIN OR REGISTER</h1>
        <h2>Welcome to the website</h2>
        <h2>Reset your password</h2>
    </div>
    <div id="vide">
    	
    </div>

    <div id="connexion">
        <img src="../Images/connexion.png" alt="Connexion" id="overlapping_image">
        <form action="update_password.php" method="POST">
            <div id="id_connexion">
                <div>
                    <div class="id_connexion">
                        <img src="../Images/user.png" alt="User">
                        <input type="text" name="id_connexion" placeholder="ID" required>
                    </div>

                    <div class="id_connexion">
                        <img src="../Images/cadenas.png" alt="Cadenas">
                        <input type="password" name="new_password" placeholder="New Password" required>
                    </div>
                </div>
            </div>

            <div id="input_connexion">
                <div>
                    <input class="button-style" type="submit" name="action_reset" value="RESET PASSWORD">
                </div>
                <div>
                    <a class="button-style" href="connexion.php">BACK TO LOGIN</a>
                </div>
            </div>
        </form>
        <?php 
        if (isset($message)) echo "<p>$message</p>"; 
        if (isset($error)) echo "<p>$error</p>"; 
        ?>
    </div>

    <div id="foot_connexion">
        <h2>Designed by Henriette Nkondi</h2>
    </div>
</body>
</html>