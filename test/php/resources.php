<?php

$resources = [
	'Name' => 'Riley',
	'FullName' => 'Riley Teige',
	'LastName' => 'Teige',
	'PersonalTitle' => 'Problem Solver'
];

function register_resources() {
	global $resources;
	
	foreach ($resources as $key => $value) {
		\templates\resource($key, $value);
	}
}

?>