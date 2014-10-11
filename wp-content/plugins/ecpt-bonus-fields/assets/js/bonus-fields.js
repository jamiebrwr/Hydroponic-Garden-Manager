jQuery(function($) {
	// colorpicker field
	$('.ecpt-color-picker').each(function(){
		var id = $(this).attr('rel');
		$(this).farbtastic('#' + id);
	});
	$('.ecpt-color-select').click(function(){
		$parent = $(this).parent();
		$(this).siblings('.ecpt-color-picker').toggle();
		$('.ecpt-color-select', $parent).toggle();
		return false;
	});
});