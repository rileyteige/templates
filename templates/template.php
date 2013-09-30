<?php

namespace templates;

require_once 'resources.php';
require_once 'replace.php';

function build_static_url($url) {
	if ($url == null) {
		return null;
	}
	
	return "static/$url";
}

function build_template_url($url) {
	if ($url == null) {
		return null;
	}
	
	return build_static_url("templates/$url");
}

function load_templated_page($filePath, $template = 'master.html') {

	$filePath = build_static_url($filePath);
	$template = build_template_url($template);
	
	if (file_exists($template) && file_exists($filePath)) {
		$templated_html = file_get_contents($template);
		$html = file_get_contents($filePath);
		
		$contentReplacer = function($matches) use ($html) {			
			return $html;
		};
		
		$templated_html = preg_replace_callback(RGX_CONTENT, $contentReplacer, $templated_html);
		$templated_html = preg_replace_callback(RGX_TAG, REPLACE_TAG, $templated_html);
		
		return $templated_html;
	}
	return null;
}

?>