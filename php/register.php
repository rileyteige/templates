<?php

$helpers = [
	'Fun' => function() {
		return "Hello, world!";
	},
	
	'Square' => function($n) {
		return $n * $n;
	},
	
	'Test' => function() {
		return 'Test function';
	},
	
	'Multi' => function($a1, $a2) {
		return "Arg1: '$a1', Arg2: '$a2'";
	},
	
	'StrInt' => function($str, $int) {
		$val = $int * 2;
		
		return "String = '$str', Int * 2 = '$val'";
	},
	
	'CircleArea' => function($d) {
		$r = $d / 2.0;
		
		return 3.14 * $r * $r;
	},
	
	'CircleInfo' => function($d) {
		$PI = 3.14;
		$r = $d / 2;
		
		$area = $PI * $r * $r;
		$circumference = $PI * $d;
		
		return json_encode(array('area' => $area, 'circumference' => $circumference));
	}
];

function register_helpers() {
	global $helpers;
	
	foreach ($helpers as $name => $fn) {
		register_helper($name, $fn);
	}
}

function register_resources() {
	resource('Name', 'Riley');
	resource('FullName', 'Riley Teige');
	resource('LastName', 'Teige');
	resource('PersonalTitle', 'Problem Solver');
}

function register_all() {
	register_helpers();
	register_resources();
}

?>