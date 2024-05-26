<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>background color</title>

	<style>
        body {
        	text-align: center;
            <?php
                if (isset($_POST['selection'])) {
                    switch ($_POST['selection']) {
                        case 'Bleu clair':
                            echo "background-color: #ADD8E6;";
                            break;
                        case 'Vert menthe':
                            echo "background-color: #98FF98;";
                            break;
                        case 'Gris clair':
                            echo "background-color: #D3D3D3;";
                            break;
                        case 'Rose pâle':
                            echo "background-color: #FFB6C1;";
                            break;
                        case 'Orange pastel':
                            echo "background-color: #FFDAB9;";
                            break;
                        case 'Jaune pâle':
                            echo "background-color: #FFFFE0;";
                            break;
                        case 'Violet lavande':
                            echo "background-color: #E6E6FA;";
                            break;
                         case 'Rouge vif':
                            echo "background-color: #FF0000;";
                            break;
                        case 'Vert vif':
                            echo "background-color: #00FF00;";
                            break;
                        case 'Bleu vif':
                            echo "background-color: #0000FF;";
                            break;
                        case 'Jaune vif':
                            echo "background-color: #FFFF00;";
                            break;
                        case 'Cyan vif':
                            echo "background-color: #00FFFF;";
                            break;
                    }
                }
            ?>
        }

        header
        {
        	font-size: 2.0em;
        }

        div form 
        {
        	font-size: 1.5em;
        }

        select, input
        {
        	padding: 5px;
        	font-size: 1em;
        	margin: 10px;
        }

        input
        {
        	background-color: rgb(155, 155, 155);
        }

        #number
        {
        	font-size: 200px;
        	padding-bottom: 7%;
        	padding-top: 7%;
        }
        footer 
		{
		    background-color: rgb(155, 155, 155, 0.3);
		    color: #fff;
		    padding: 2%;
		    color: black;
		}
    </style>
</head>
<body>
	<header>
		<h1>Background Color</h1>
	</header>

	<div>
		<form action="#" method="POST">
			<label for="selection"> Choisissez une couleur à mettre en fond : </label>

			<select name="selection" id="selection">
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Bleu clair') echo 'selected'; ?>>Bleu clair</option>
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Vert menthe') echo 'selected'; ?>>Vert menthe</option>
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Gris clair') echo 'selected'; ?>>Gris clair</option>
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Rose pâle') echo 'selected'; ?>>Rose pâle</option>
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Orange pastel') echo 'selected'; ?>>Orange pastel</option>
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Jaune pâle') echo 'selected'; ?>>Jaune pâle</option>
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Violet lavande') echo 'selected'; ?>>Violet lavande</option>
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Rouge vif') echo 'selected'; ?>>Rouge vif</option>
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Vert vif') echo 'selected'; ?>>Vert vif</option>
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Bleu vif') echo 'selected'; ?>>Bleu vif</option>
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Jaune vif') echo 'selected'; ?>>Jaune vif</option>
				<option <?php if(isset($_POST['selection']) && $_POST['selection'] == 'Cyan vif') echo 'selected'; ?>>Cyan vif</option>
			</select>

			<input type="submit" name="submit">
		</form>

	</div>

	<div id="number">
		<?php
            
            if (isset($_POST['submit'])) {
                echo rand(1, 1000);
            }
        ?>
	</div>
	
	<footer>
        &copy; 2023-2024      Henriette        Nkondi        Background_Color
    </footer>

</body>
</html>