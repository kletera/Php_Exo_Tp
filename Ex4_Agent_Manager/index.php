<?php
session_start();

include_once './utils/database.php';
include './controller/ControllerInscription.php';

$model = new ModelInscription(connect_bdd());
$view = new ViewInscription();

$controller = new ControllerInscription($model, $view);
$controller->render();

include './controller/ControllerAgents.php';
$model= new Agent(connect_bdd());

$view= new ViewAgents();

$ControllerAgents = new ControllerAgents($model,$view);
$ControllerAgents->render();