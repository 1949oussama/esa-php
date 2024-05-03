<?php ob_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperation</title>
    <style>
        /* Style pour centrer la phrase sur la page */
        body, html {
            height: 100%; 
            margin: 0;
            display: flex; 
            justify-content: center; 
            align-items: center; 
            font-family: Arial, sans-serif; 
            font-weight: bold; 
            font-size: 30px;
        }
    </style>
</head>

<body>
    <?php
        $msg = 'Vous ne disposez pas de 10 mots';
        $nombre_mot = str_word_count($_POST['phrase']);
        
        // Vérifie si la chaîne contient au moins 10 mots
        if ($nombre_mot<10){
            header('Location: index.php?msg=' . urlencode($msg));
        }

        function colortext($mot){
            /**
             * @author Henriette Nkondi
             * @version 1.0
             * 
             */
            $colors = ['black', 'yellow', 'red'];

            $colorIndex = 0;  
            $output = " ";     
        
            for ($i = 0; $i < strlen($mot); $i++) {
                
                // Ignorer les espaces pour l'attribution des couleurs
                if ($mot[$i] !== ' ') {
                    $output .= "<span style='color: " . $colors[$colorIndex] . ";'>$mot[$i]</span>";
                    // Passer à la couleur suivante
                    $colorIndex = ($colorIndex + 1) % count($colors);
                } 
                else {
                    // Ajouter l'espace sans couleur
                    $output .= "&nbsp;&nbsp;";
                }
            }

            return $output;
        }

        echo colortext($_POST['phrase']);

    ?>
</body>
</html>