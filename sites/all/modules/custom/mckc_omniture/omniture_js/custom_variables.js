(function ($) {
// custom prop vars for omniture
	$('.download-video').delegate('a', 'click', function(){
        var rawpageTitle = $(document).attr('title').split('|');
		var pageTitle = $.trim(rawpageTitle[0]);
        s.linkTrackVars = 'prop5,prop3,prop8';
        s.linkTrackEvents = 'None';
        s.prop5 = pageTitle;
        var pidx = Drupal.settings.myOmniture.pidX;
        s.prop3 = pidx;
        s.prop8 = pidx;
        s.tl(this, 'd');
	});
})(jQuery);