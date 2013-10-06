<?php

require_once 'php/setup.php';

register_all();

$app = new \Slim\Slim();

$app->get('/', function() {
	$page = load_templated_page(SITE_HOME_PAGE);

	$obj = new stdClass();
	$obj->text = "This is model text.";
	
	$page = templates\apply_model($obj, $page);
	
	echo $page;
});

$app->get('/:page', function($page) {
	if (strpos($page, '.html') == FALSE) {
		$page = "$page.html";
	}
	
	$html = load_templated_page($page);
	
	echo $html;
});

$app->run();

?>