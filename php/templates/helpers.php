<?php

$__templates__helpers = [
	'Css' => function($stylesheet) {
		return '<link rel="stylesheet" type="text/css" href="css/'.$stylesheet.'">';
	},
	
	'Script' => function($script) {
		return '<script type="text/javascript" src="js/'.$script.'"></script>';
	}
];

function register_helper($name, $fn) {
	global $__templates__helpers;
	
	$__templates__helpers[$name] = $fn;
}

function get_helper($helperName) {
	global $__templates__helpers;
	
	if (array_key_exists($helperName, $__templates__helpers)) {
		return $__templates__helpers[$helperName];
	}
	
	return null;
}

function exec_helper($helperName, $args) {
	$fn = get_helper($helperName);
	if ($fn == null) {
		return null;
	}
	
	try {
		return call_user_func_array($fn, $args);
	} catch (Exception $e) {
		return null;
	}
}

?>