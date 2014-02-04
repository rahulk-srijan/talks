/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery('document').ready(function() {
    jQuery('#organisation-video-library-gallery a').each(function() { 
        var href = jQuery(this).attr('href');
        if(href){
            var ex_href = href.split("/");
            //var t = 'globalcomm';orginaction
            if(ex_href[1]){
            var str_length = parseInt(ex_href[1].length+1);
            if(ex_href[1] == ex_href[2]){
                var sub_href= href.substr(str_length,9000);
                jQuery(this).attr('href', sub_href);
            }
            }
        }
    });
});