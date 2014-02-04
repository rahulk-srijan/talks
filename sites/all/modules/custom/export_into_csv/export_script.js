/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var i;
(function($) {

    Drupal.behaviors.export_into_csv = {
        attach: function(context, settings) {
            $('.download-user-stats a', context).click(function() {
                $('#wait-animation').show('slow');
                //document.location.href = '/admin/people/video-stats';
                //jQuery('#wait-animation').hide();
                //setTimeout( "$('#wait-animation').hide();",1000);

                //setTimeout('getstatus()', 5000);
                i = setInterval('getstatus()', 5000);
            });
        }

    };

}(jQuery));


function getstatus() {
    jQuery.ajax({
        url: Drupal.settings.basePath + "admin/people/check-download-status",
        type: "GET",
        dataType: 'json',
        success: function(data) {
            if (data == "fail") {
            } else
                jQuery('#wait-animation').hide('slow');
            clearInterval(i);
        }
    });
}