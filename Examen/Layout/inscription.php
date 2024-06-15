<?php ob_start(); ?>
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
        require 'function.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['id_connexion'];
            $password = $_POST['password_connexion'];
            if (inscrire($username, $password)) {
                // Créer un fichier CSV pour l'utilisateur
        $file = getUserCsvFilePath($username);
        $handle = fopen($file, 'w');
        fclose($handle);
                $_SESSION['user_id'] = $username;
                header("Location: connexion.php");
                exit();
            } else {
                $error = "Nom d'utilisateur déjà existant ou erreur d'inscription.";
            }
        }
    ?>

    <div id="head_connexion">
        <h1>USER REGISTER</h1>
        <h2>Welcome to the website</h2>
    </div>

    <div id="connexion">
        <img src="../Images/connexion.png" alt="Connexion" id="overlapping_image">
        <form action="inscription.php" method="POST">
            <div id="id_connexion">
                <div>
                    <div class="id_connexion">
                        <img src="../Images/user.png" alt="User">
                        <input type="text" name="id_connexion" placeholder="ID" required>
                    </div>

                    <div class="id_connexion">
                        <img src="../Images/cadenas.png" alt="Cadenas">
                        <input type="password" name="password_connexion" placeholder="Password" required>
                    </div>
                </div>
            </div>

            <div id="input_connexion">
                <div>
                    <input class="button-style" type="submit" name="action_inscription" value="REGISTER">
                </div>
                <div>
                    <a href="connexion.php" class="button-style">BACK TO LOGIN </a>
                </div>
            </div>
        </form>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </div>

    <div id="foot_connexion">
        <h2>Designed by Henriette Nkondi</h2>
    </div>
    
</body>
</html>
