<?php
require_once 'php/setup.php';

$app = new \Slim\Slim();

$app->get('/', function() {
	$page = load_templated_page(SITE_HOME_PAGE);

	echo $page;
});

$app->get('/:page', function($page) {
	if (strpos($page, '.html') == FALSE) {
		$page = "$page.html";
	}
	
	$html = load_templated_page($page);
	
	echo $html;
});

register_helper('Fun', function() {
	return "Hello, world!";
});

register_helper('Square', function($n) {
	return $n * $n;
});

$app->run();
?>