<?php

$helpers = [
	'Css' => function($filename) {
		return '<link type="text/css" rel="stylesheet" href="/rileyteige.com/css/'.$filename.'" />';
	},
	
	'Script' => function($filename) {
		return '<script type="text/javascript" src="/rileyteige.com/js/'.$filename.'"></script>';
	},
	
	'Test' => function() {
		return '2';
	},
	
	'Multi' => function($arg1, $arg2) {
		return "arg1: $arg1, arg2: $arg2";
	},
	
	'StrInt' => function($str, $int) {
		$val = $int * 2;
		return "$str $val";
	},
	
	'CircleArea' => function($d) {
		$r = $d / 2.0;
		return 3.14 * $r * $r;
	},
	
	'CircleInfo' => function($d) {
		$r = $d / 2.0;
		$area = 3.14 * $r * $r;
		$circ = 3.14 * $d;
		return json_encode(array('area' => $area, 'circumference' => $circ));
	}
];


function get_helper($helperName) {
	global $helpers;
	
	if (array_key_exists($helperName, $helpers)) {
		return $helpers[$helperName];
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