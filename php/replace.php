<?php

require_once 'helpers.php';

define('TAG_OPEN', '{{');
define('TAG_CLOSE', '}}');
define('FN_PARAM_OPEN', '(');
define('FN_PARAM_CLOSE', ')');
define('STR_SINGLE', '\'');
define('STR_DOUBLE', '"');

define('PTN_FN_ARGS', '\(.*\)');

define('RGX_TAG', '/(?<!\\\\)(('.TAG_OPEN.'\s*)(.+?)(\s*'.TAG_CLOSE.'))+?/i');
define('RGX_CONTENT', '/'.TAG_OPEN.'CONTENT'.TAG_CLOSE.'/');
define('RGX_FN_ARGS', '/'.PTN_FN_ARGS.'/');
define('RGX_FN', '/\w+'.PTN_FN_ARGS.'/');
define('RGX_FN_NAME', '/\w*/');

function replace_helper($tag) {
	// return exec_helper('Css', ['test.css']);
	
	preg_match(RGX_FN_NAME, $tag, $matches);
	$name = $matches[0];
	
	preg_match(RGX_FN_ARGS, $tag, $matches);
	$argsString = str_replace([FN_PARAM_OPEN, FN_PARAM_CLOSE, STR_SINGLE], '', $matches[0]);
	$args = explode(',', $argsString);
	
	return exec_helper($name, $args);
}

function replace_tag($matches) {
	$match = $matches[0];
	
	$tag = str_replace([TAG_OPEN, TAG_CLOSE], '', $match);
	$tag = trim($tag);
	
	if (preg_match(RGX_FN, $tag)) {
		return replace_helper($tag);
	}
	
	$resource = get_resource($tag);
	
	return $resource != null ? $resource : $match;
}

define('REPLACE_TAG', 'replace_tag');
?>