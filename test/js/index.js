(function($) {
	$(function() {
		var $tag = $('#cssCode');
		
		var html = $tag.html();
		
		$tag.html(html.replace('<', '&lt;').replace('>', '&gt;'));
	});
})(jQuery);