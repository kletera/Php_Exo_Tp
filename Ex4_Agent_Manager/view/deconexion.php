<?php
//Démarrer la session
session_start();

//Suppression de la session
session_destroy();

// Redirection
header('Location:../index.php');

exit;