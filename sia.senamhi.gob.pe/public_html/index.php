<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

/** CONTROLLER **/
require_once 'src/Template/TemplateController.php';
require_once 'src/Menu/MenuController.php';
require_once 'src/Historial/HistorialController.php';

/** MODELS **/
require_once 'src/Menu/Menu.php';
require_once 'src/Historial/Historial.php';

/** HELPERS **/
require_once 'helpers/init.php';

$template = new TemplateController();
$template->ver();
