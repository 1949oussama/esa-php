<?php ob_start();
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
    require_once 'Control/function.php';

    // Vérifiez les informations de connexion
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['id_connexion'];
        $password = $_POST['password_connexion'];

        if (authentifier($username, $password)) {
        	// Stocker les informations de l'utilisateur dans la session
            $_SESSION['username'] = $username;
            header("Location: Views/page.php");
            exit();
        } 
        else {
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TO DO LIST</title>
	<link rel="stylesheet" type="text/css" href="../Css/reset.css">
	<link rel="stylesheet" type="text/css" href="../Css/style_connexion.css">
</head>
<body>

	<div id="head_connexion">
		<h1>USER LOGIN OR REGISTER</h1>
		<h2>Welcome to the website</h2>
	</div>

	<div id="connexion">
		<img src="../Images/connexion.png" alt="Connexion" id="overlapping_image">
		<form action="index.php" method="POST">
			<div id="id_connexion">
				<div>
					<div class="id_connexion">
						<img src="Images/user.png" alt="User">
						<input type="text" name="id_connexion" placeholder="ID" required>
					</div>

					<div class="id_connexion">
						<img src="Images/cadenas.png" alt="Cadenas">
						<input type="password" name="password_connexion" placeholder="Password" required>
					</div>
				</div>

				<div id="forgot_connexion">
					<a href="Layout/update_password.php">Forgot Password ? </a>
				</div>
			</div>

			<div id="input_connexion">
                <div>
                    <input class="button-style" type="submit" name="action_connexion" value="LOGIN">
                </div>
                <div>
                    <a class="button-style" href="Layout/inscription.php">REGISTER</a>
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