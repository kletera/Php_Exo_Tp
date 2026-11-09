<?php
include 'Des.php';
include 'Joueur.php';
include 'Partie.php';
$partie = new Partie(new Joueur('Olivier',new Des(6)), new Joueur('Seb',new Des(6)),5);
$partie->lancerPartie();
