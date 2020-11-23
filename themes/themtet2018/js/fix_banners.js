if ($('.fix_banner_left').length > 0 && $('.fix_banner_right').length > 0) {
	var _top = 10
	$(window).scroll(function(evt) {
		var _y = $(this).scrollTop();
		if (_y > _top) {
			$('.fix_banner_left').addClass('fixed_banner');
			$('.fix_banner_right').addClass('fixed_banner_right');
		} else {
			$('.fix_banner_left').removeClass('fixed_banner');
			$('.fix_banner_right').removeClass('fixed_banner_right');
		}
	})
}