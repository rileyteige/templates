<?php

require_once 'rb.php';
require_once 'Slim/Slim/Slim.php';
require_once 'templates/setup.php';

require_once 'globals.php';
require_once 'register.php';

\Slim\Slim::registerAutoloader();
R::setup('mysql:host=localhost;dbname=Teige', 'root', '');

function load_templated_page($page, $master = 'master.html') {
	return \templates\load_templated_page($page, $master);
}
?>