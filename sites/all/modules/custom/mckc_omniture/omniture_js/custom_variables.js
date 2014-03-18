(function ($) {
// custom prop vars for omniture
	$('.download-video').delegate('a', 'click', function(){
        var rawpageTitle = $(document).attr('title').split('|');
		var pageTitle = $.trim(rawpageTitle[0]);
        s.linkTrackVars = 'prop1,prop5,prop6';
        s.linkTrackEvents = 'None';
        s.prop5 = pageTitle;
        var pidx = Drupal.settings.myOmniture.pidX;
        s.prop1 = pidx;
        s.prop6 = pidx;
        s.tl(this, 'd');
	});
})(jQuery);