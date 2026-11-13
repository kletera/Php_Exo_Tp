<?php
session_start();
include_once './utils/database.php';

$page = $_GET['page'] ?? 'inscription';

switch ($page) {
    case '':
        include './controller/ControllerInscription.php';
        break;
    case 'connexion':
        include './controller/ControllerConnexion.php';
        break;
    case 'accueil':
        include './controller/ControllerAcccueil.php';
        break;
    case 'agents':
        include './controller/ControllerAgents.php';
        break;
    case 'moncompte':
        include './controller/ControllerMonCompte.php';
        break;
    case 'deconnexion':
        include './utils/deconexion.php';
        break;
    default:
        include './controller/ControllerInscription.php';
        break;
}