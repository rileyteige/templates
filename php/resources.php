<?php

$resources = [
	'FullName' => 'Riley Teige',
	'Name' => 'Riley',
	'PersonalTitle' => 'Software Developer'
];


function get_resource($res) {
	global $resources;
	
	if (array_key_exists($res, $resources)) {
		return $resources[$res];
	}
	
	return null;
}
?>