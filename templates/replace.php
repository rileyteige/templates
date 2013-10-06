<?php

namespace templates;

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

function prepare_tag($tag) {
	$tag = str_replace([TAG_OPEN, TAG_CLOSE], '', $tag);
	$tag = trim($tag);
	
	return $tag;
}

function replace_object($tag, $object) {
	$tagBody = prepare_tag($tag);

	if (strpos($tagBody, 'Model.') === FALSE) {
		return $tag;
	}
	
	$tagBody = str_replace('Model.', '', $tagBody);
	
	$prop = lcfirst($tagBody);	
	return isset($object->$prop) ? $object->$prop : '';
}

define('FN_REPLACE_HELPER', __NAMESPACE__.'\replace_helper');
function replace_helper($tag) {
	preg_match(RGX_FN_NAME, $tag, $matches);
	$name = $matches[0];
	
	preg_match(RGX_FN_ARGS, $tag, $matches);
	$argsString = str_replace([FN_PARAM_OPEN, FN_PARAM_CLOSE, STR_SINGLE], '', $matches[0]);
	$args = explode(',', $argsString);
	
	return exec_helper($name, $args);
}

function replace_tag($matches) {
	$match = $matches[0];
	
	$tag = prepare_tag($match);
	
	$doReplace = null;	
	if (preg_match(RGX_FN, $tag)) {
		$doReplace = FN_REPLACE_HELPER;
	} else {
		$doReplace = FN_GET_RESOURCE;
	}
	
	$rtn = $doReplace($tag);
	
	return $rtn != null ? $rtn : $match;
}

define('REPLACE_TAG', __NAMESPACE__.'\replace_tag');
?>