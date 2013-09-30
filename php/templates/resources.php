<?php

$__templates__resources = [];

function resource($k, $v) {
	global $__templates__resources;

	$__templates__resources[$k] = $v;
}

function get_resource($res) {
	global $__templates__resources;
	
	if (array_key_exists($res, $__templates__resources)) {
		return $__templates__resources[$res];
	}
	
	return null;
}

define('FN_GET_RESOURCE', 'get_resource');
?>