<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drapeau Belge</title>
    <style>
        /* Style pour centrer le formulaire sur la page */
        body, html {
            height: 100%;
            margin: 0; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            font-family: Arial, sans-serif; 
        }
        
        form {
            width: 90%;  
            padding: 20px; 
            box-shadow: 0 0 10px rgba(155,155,155,0.8);
            border-radius: 8px;
            background-color: #feeffe;
        }

        label, textarea {
            width: 100%; 
            box-sizing: border-box; 
        }

        textarea {
            height: 150px; 
            padding: 10px; 
            margin-top: 8px; 
        }
        
        input[type="submit"] {
            margin-top: 10px; /* Espace entre le textarea et le bouton */
            cursor: pointer; /* Change le curseur pour indiquer que c'est un bouton cliquable */
        }

    </style>
</head>
<body>
    <form action="recuperation.php" method="post">
        <label for="phrase">Phrase</label>
        <textarea name="phrase" id="phrase" placeholder="Entrez une phrase de 10 mots minimum"></textarea>

        <input type="submit">
    </form>
</body>
</html>
