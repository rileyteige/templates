<?php

require_once 'globals.php';
require_once 'rb.php';
require_once 'Slim/Slim/Slim.php';
include_once 'resources.php';
include_once 'template.php';

\Slim\Slim::registerAutoloader();
R::setup('mysql:host=localhost;dbname=Teige', 'root', '');
?>