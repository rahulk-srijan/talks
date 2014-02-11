/**jQuery('document').ready(function() {
    jQuery('#header a, #branding a, #dashboard a, #block-system-main a, #block-menu-menu-webmaster-menu a').each(function() { 
        var href = jQuery(this).attr('href');
        var ex_href = href.split("/");
        var t = 'globalcomm';
        /* junction appends the globalcomm sub-domain, which we
 *is being removed.
 * Note: settings.php has the full URL, including the globalcomm sub-domain
 */
/**
       if(ex_href[1] == t && ex_href[2] == t){
            var sub_href= href.substr(11,9000);
            jQuery(this).attr('href', sub_href);
        }
    });
});*/

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery('document').ready(function() {
    jQuery('#organisation-video-library-gallery a').each(function() { 
        var href = jQuery(this).attr('href');
        var ex_href = href.split("/");
        var t = 'globalcomm';
        if(ex_href[1]== t && ex_href[2] == t){
            var sub_href= href.substr(11,9000);
            jQuery(this).attr('href', sub_href);
        }
    });
});