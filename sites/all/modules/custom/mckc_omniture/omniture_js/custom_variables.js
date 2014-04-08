(function ($) {
// custom prop vars for omniture
	$('.download-video').delegate('a', 'click', function(){
        var rawpageTitle = $(document).attr('title').split('|');
		var pageTitle = $.trim(rawpageTitle[0]);
        s.linkTrackVars = 'prop1,prop3,prop5';
        s.linkTrackEvents = 'None';
        s.prop5 = pageTitle;
        var pidx = Drupal.settings.myOmniture.pidX;
        var channel = Drupal.settings.myOmniture.channel;
        s.prop1 = pidx;
        s.prop3 = channel;
        s.tl(this, 'd');
	});
})(jQuery);