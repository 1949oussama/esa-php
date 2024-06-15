<?php
$background_color = isset($_GET['background_color']) ? $_GET['background_color'] : '#ffffff';
setcookie('background_color', $background_color, time() + (3600), "/"); 
header('Location: ../index.php');
exit();
?>
