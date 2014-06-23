/*var inNum;
 var outNum;
 var COOKIE_NAME = "my_carousel_position";

 // MANAGE COOKIES
 function setCookie(cName, cValue, cDaysNum)
 {
 var date = new Date();
 date.setTime(date.getTime() + (cDaysNum * 24 * 60 * 60 * 1000));
 jQuery.cookie(cName, cValue, {  expires: date });
 return false;
 }

 function getCookie(cName)
 {
 return jQuery.cookie(cName);
 }

 function delCookie(cName)
 {
 date = "Thu, 01-Jan-70 00:00:01 GMT";
 jQuery.cookie(cName, null, {  expires: date });
 return false;
 }
 // END MANAGE COOKIES

 function mycarousel_itemVisibleOutCallback(carousel, item, i, state, evt)
 {
 outNum = i;
 setPosition();
 };

 function mycarousel_itemVisibleInCallback(carousel, item, i, state, evt)
 {
 inNum = i;
 };

 // calculate first visible item
 function getFirstVisibleItemId(inNum, outNum)
 {
 minVal = Math.min(inNum, outNum);
 if(inNum == minVal){
 minVal--;
 }
 return minVal;
 }

 //set new carousel position in cookie
 function setPosition()
 {
 position = getFirstVisibleItemId(inNum, outNum)
 if(position >= 0 ){
 value = position+1;
 setCookie(COOKIE_NAME, value, 1);
 }
 }

 //retrieves carousel position from cookie
 function getPosition()
 {
 startVal = 1;
 var cookieVal = getCookie(COOKIE_NAME);
 if(cookieVal != null){
 startVal = parseInt(cookieVal);
 }else{
 delCookie(COOKIE_NAME);
 }
 return startVal;
 }*/
//window.onload = function(){ alert("welcome"); }
//Drupal.settings.basePath = "devhome.intranet.mckinsey.com/globalcomm/VideoLibraryD7/";
//Drupal.settings.baseurl = Drupal.settings.basePath;


jQuery('document').ready(function() {
    if (jQuery(window).width() > 700) {
        jQuery(".slideshow-body").more({length: 200, moreText: 'more', lessText: 'less'});
        jQuery(".views-field-message-render .title .comment-body").more({length: 145, moreText: ''});

        jQuery(".comment-form.title.comment-title").bind("click", function() {
            jQuery("div#comment-form").slideToggle();
        });
    }
    var w = jQuery('#widget_pager_bottom_featured_vedios-block').width();
    var x = w + 33;
    jQuery('#views_slideshow_controls_text_next_featured_vedios-block').css('left', x);


    jQuery("#views_slideshow_cycle_teaser_section_logging-block .views-slideshow-cycle-main-frame-row").each(function() {
        jQuery(this).find(".views-field-message-render .author").insertAfter(jQuery(this).find(".views-field-message-render .latest"));
    });

    jQuery("body.page-my-playlist .flag").text("Remove");
    // jQuery("body.page-my-playlist a.flag").on('click', function() {
    //   if(jQuery("body.page-my-playlist a.flag").text() == "Remove from my playlist") {
    //     jQuery("body.page-my-playlist a.flag").text("Remove");
    //   }
    // });

    addDivNewsletter();
    addLabel();
    trimLatestActivity();
    tooglechild();
    carousel();
    activetag();
    trigger();
    resetHiddenFieldValue();
    addRemoveBorder();
    addNewsletterClass();
    changeCheckBoxToRadio();
    uncheckRadio();
    checkedAllCategory();

    sort_autosubmit();
    checkChildCategory();
    suggestLink();
    toogleSearch()

    if (jQuery(window).width() < 700)
    mobileTweaks();
    defaultText();


var value = null; //set a default value

setTimeout( function(){
     value =  jQuery('#block-views-child-library-block-block, #block-views-child-library-block-block-3').toggle();
}, 14000); //14 seconds

setTimeout( function(){
     value =  jQuery('#block-views-child-library-block-block-4, #block-views-child-library-block-block-1').toggle();
}, 12000); //12 seconds

setTimeout( function(){
     value =  jQuery('#block-views-child-library-block-block-2, #block-views-child-library-block-block-5').toggle();
}, 10000); //10 seconds


});



function addDivNewsletter() {
    //console.log(Drupal.settings);
    if (typeof Drupal.settings.roles === 'object') {
        var roles_array = jQuery.map(Drupal.settings.roles, function(value, index) {
         return [value];
        });
    }
    else {
        var roles_array = Drupal.settings.roles;
    }

    var count_bto = Drupal.settings.term_count[0];
    var count_ops = Drupal.settings.term_count[1];
    var count_org = Drupal.settings.term_count[2];
    var count_it = Drupal.settings.term_count[3];
    var count_ndm = Drupal.settings.term_count[4];
    var count_entre = Drupal.settings.term_count[5];
    var count_compete = Drupal.settings.term_count[6];

    var role_entre = jQuery.inArray("entrepreneur user",roles_array);
    var role_entre_ors = jQuery.inArray("ors entrepreneur user",roles_array);
    var role_entre_admin = jQuery.inArray("entrepreneur web master",roles_array);
    var role_compete = jQuery.inArray("compete to win user",roles_array);
    var role_compete_ors = jQuery.inArray("ors compete to win user",roles_array);
    var role_compete_admin = jQuery.inArray("compete to win web master",roles_array);
    var role_superadmin = jQuery.inArray("super admin",roles_array);
    var start = 6;
    var term_count_bto = (1 + Drupal.settings.term_count[0]) + start;

    var term_count_ops = (1 + Drupal.settings.term_count[1]) + term_count_bto;
    var term_count_org = (1 + Drupal.settings.term_count[2]) + term_count_ops;
    var term_count_it = (2 + Drupal.settings.term_count[3]) + term_count_org; //we used 2 instead of one because of spotlight category, hidden with css
    var term_count_ndm = (1 + Drupal.settings.term_count[4]) + term_count_it;
    var term_count_entrepreneur = (1 + Drupal.settings.term_count[6]) + term_count_ndm;
    var term_count_compete = (1 + Drupal.settings.term_count[5]) + term_count_entrepreneur;
   //jQuery('#edit-newsletters').append('<div id="bto-newsletter" class="newsletter-block">' + news + '</div>');
   jQuery('#edit-newsletters .form-item').slice(start, term_count_bto).wrapAll('<div id="bto-newsletter" class="newsletter-block" />');
   jQuery('#edit-newsletters .form-item').slice(term_count_bto, term_count_ops).wrapAll('<div id="ops-newsletter" class="newsletter-block" />');
   jQuery('#edit-newsletters .form-item').slice(term_count_ops, term_count_org).wrapAll('<div id="org-newsletter" class="newsletter-block" />');
   jQuery('#edit-newsletters .form-item').slice(term_count_org, term_count_it).wrapAll('<div id="it-newsletter" class="newsletter-block" />');
   jQuery('#edit-newsletters .form-item').slice(term_count_it, term_count_ndm).wrapAll('<div id="ndm-newsletter" class="newsletter-block" />');
    jQuery('#edit-newsletters .form-item').slice(term_count_ndm, term_count_entrepreneur).wrapAll('<div id="entrepreneur-newsletter" class="newsletter-block" />');
    jQuery('#edit-newsletters .form-item').slice(term_count_entrepreneur, term_count_compete).wrapAll('<div id="compete-newsletter" class="newsletter-block" />');
    if((role_entre == -1) && (role_entre_ors ==-1) && (role_entre_admin==-1) && (role_superadmin==-1)) {
        jQuery('#entrepreneur-newsletter').remove();
    }
    // if(role_entre_ors== -1) {
    //     jQuery('#entrepreneur-newsletter').remove();
    // }
    if ((role_compete == -1) && (role_compete_ors ==-1) && (role_compete_admin==-1) && (role_superadmin==-1)) {
        jQuery('#compete-newsletter').remove();
    }

   jQuery('#bto-newsletter .form-item-newsletters-457').css('padding-bottom',count_bto*25+'px');
   jQuery('#ops-newsletter .form-item-newsletters-456').css('padding-bottom',count_ops*25+'px');
   jQuery('#org-newsletter .form-item-newsletters-455').css('padding-bottom',count_org*25+'px');
   jQuery('#it-newsletter .form-item-newsletters-609').css('padding-bottom',count_it*25+'px');
   jQuery('#ndm-newsletter .form-item-newsletters-610').css('padding-bottom',count_ndm*25+'px');
   jQuery('#entrepreneur-newsletter .form-item-newsletters-611').css('padding-bottom',count_entre*25+'px');
   jQuery('#compete-newsletter .form-item-newsletters-612').css('padding-bottom',count_compete*25+'px');
   //jQuery('#edit-newsletters .form-item:gt(13):lt(22)').wrapAll('<div id="ops-newsletter" class="newsletter-block" />');
   //jQuery('#edit-newsletters .form-item:gt(21):lt(25)').wrapAll('<div id="org-newsletter" class="newsletter-block" />');
   jQuery('#bto-newsletter').before('<p class="main-cat" id="bto-collapsible">BTO Academy Notifications</p>').hide();
   jQuery('#ops-newsletter').before('<p class="main-cat" id="ops-collapsible">Ops in Action Notifications</p>').hide();
   jQuery('#org-newsletter').before('<p class="main-cat" id="org-collapsible">Org in Action Notifications</p>').hide();
   jQuery('#it-newsletter').before('<p class="main-cat" id="it-collapsible">Our Technology Notifications</p>').hide();
   jQuery('#ndm-newsletter').before('<p class="main-cat" id="ndm-collapsible">MI Matters Notifications</p>').hide();
   jQuery('#entrepreneur-newsletter').before('<p class="main-cat" id="entrepreneur-collapsible">Entrepreneurship Stories Notifications</p>').hide();
   jQuery('#compete-newsletter').before('<p class="main-cat" id="compete-collapsible">Compete to Win Notifications</p>').hide();
   jQuery('.main-cat').each(function() {
        jQuery(this).click(function(){
            jQuery(this).next().toggle();
            jQuery(this).toggleClass('expanded-newsletter');
        });
   });
}

function trimLatestActivity() {
    var testing = jQuery(".views-slideshow-cycle-main-frame-row p.title span");
    testing.each(function() {
        textlng = jQuery(this).text().length;
        if(textlng > 145){
            jQuery(this).text(jQuery(this).text().substr(0, 145)+ '...');
        }
    });
}

function toggleControls() {
    jQuery(".category-filter-toggle .filter-search-facet").click(function() {
        jQuery(".region-sidebar-first").toggle();
        jQuery(this).toggleClass("active");

        jQuery("#block-apachesolr-search-sort").hide();
        jQuery(".category-filter-toggle .date-search-facet").removeClass("active");
    });

    jQuery(".category-filter-toggle .date-search-facet").click(function() {
        jQuery("#block-apachesolr-search-sort").toggle();
        jQuery(this).toggleClass("active");

        jQuery(".region-sidebar-first").hide();
        jQuery(".category-filter-toggle .filter-search-facet").removeClass("active");
    });

    jQuery(".block-facetapi-category").addClass("is-expanded");
    jQuery(".block-facetapi-library").addClass("is-expanded");
    jQuery(".block-facetapi-category, .block-facetapi-date, .block-facetapi-library").click(function() {
        jQuery(".block-content", jQuery(this)).toggle();
        jQuery(this).toggleClass("is-expanded");
    });
    jQuery('html').bind('click touchstart', function(){
        jQuery(".region-sidebar-first, #block-apachesolr-search-sort").hide();
        jQuery(".filter-search-facet").removeClass("active");
        jQuery(".date-search-facet").removeClass("active");
    });

      jQuery('.category-filter-toggle div, .region-sidebar-first, #block-apachesolr-search-sort, .clear-search-result').bind('click touchstart', function(e){
      e.stopPropagation(); // stop document clicking and hiding dropdown.
      //return false;
    });

}

function sort_autosubmit() {
    jQuery('.form-item-apachesolr-sort-name select').change(function() {
        // Submit the form
        jQuery("#apachesolr-sort-sort-form-").submit();
    });
//    }
}
function search_trim() {
    jQuery(".search-snippet-info .search-snippet .video-title").more({length: 70, moreText: ''});
    jQuery(".search-snippet .snippet").more({length: 70, moreText: ''});
}
function mobileTweaks() {
    // Top Nav
    menuMobile();

    menustripMobile();
    //Notification Order Fix
    notifiReorder();

    // Sort/Filter Controls
    toggleControls();

    // Trim
    jQuery(".slideshow-body").more({length: 100, wordBreak: true, moreText: 'more', lessText: 'less'});
    jQuery(".popular-video-slide .video-body").more({length: 100, wordBreak: true, moreText: 'more', lessText: 'less'});
    jQuery(".feat-videos-title").more({length: 35, moreText: ''});

    search_trim();



    // Featured Height
    featHeight();

    // Toggle Comments on URL anchor
    toggleComments();

    // Modal
    popupModal("#authorize ul.user li.last a", "#authorize ul.user li.last .modal");
    popupModal("#authorize ul.user li.second a", "#block-custom-ovl-noti-block");
    popupModal(".comment-form.title.comment-title", "div#comment-form");

    // Select2 functionality
    tag_select();

    // Autocomplete input box
//  jQuery("input.form-text").attr("title", "Filter by Author or Tag");

    // Sort by toggle
    sortToggle();

    // Tag Reset button
    jQuery(".reset-cat").insertAfter(".views-widget-filter-name .form-item-name input.form-text, #s2id_edit-tid-1");
    // jQuery(".reset-cat").clone().insertAfter("#s2id_edit-tid-1");
}

function sortToggle() {
    jQuery(".views-widget-sort-by .form-item-sort-by label").bind('click', function() {
        jQuery(".views-widget-sort-by .form-item-sort-by .bef-select-as-links").slideToggle();
        jQuery(".views-widget-sort-by .form-item-sort-by label").toggleClass("pressed");
    });
}

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
function tag_select() {
    jQuery("#edit-tid-1").find('option[value="All"]').text("");
    jQuery("#edit-tid-1").find('option[value="All"]').attr('value', '');
    jQuery("#edit-tid-1").val(getUrlVars()['tid']);
    //  jQuery('#edit-tid-1').find('option[value="All"]:first').prop('selected', true);
    jQuery("#edit-tid-1").select2({
        placeholder: "Select Tag to Filter"
    });
    jQuery('#edit-tid-1').bind('change', function() {
        if (jQuery(this).val()) {
            window.location = '?tid=' + jQuery(this).val();
        }
        return false;
    });

    // jQuery('#edit-tid-1')jQuery(this).val().attr('selected','selected');
    // console.log(getUrlVars());
}


function featHeight() {
    jQuery("#views_slideshow_cycle_teaser_section_featured_vedios-block").height(jQuery(".views_slideshow_slide").height());

    jQuery("#views_slideshow_cycle_teaser_section_featured_vedios-block .views_slideshow_slide").resize(function() {
        jQuery("#views_slideshow_cycle_teaser_section_featured_vedios-block .views_slideshow_slide").each(function(index) {
            // console.log('yo');
            if (jQuery(this).is(":visible")) {
                jQuery("#views_slideshow_cycle_teaser_section_featured_vedios-block").height(jQuery(this).height());
                // console.log(jQuery("#views_slideshow_cycle_teaser_section_featured_vedios-block").height());
            }
        });
        // jQuery("#views_slideshow_cycle_teaser_section_featured_vedios-block").height(jQuery(".views_slideshow_slide").height());
    });
}

function notifiReorder() {
    //jQuery(".form-item-newsletters-53").insertBefore(".form-item-newsletters-54");
    // jQuery('#simplenews-subscriptions-page-form .fequency [type=checkbox]').parent().remove();
    jQuery(".form-item-newsletters-54").insertAfter(".form-item-newsletters-53");

    jQuery('.fequency').insertBefore('#edit-emai-textl');
    // jQuery(".edit-newsletters .fequency").after('#edit-emai-textl');
    //jQuery("").insertAfter(jQuery());
    //jQuery(".form-item-newsletters-1").insertBefore(".form-item-newsletters-2");
    jQuery(".all-new-videos").insertAfter("#edit-emai-textl");
    jQuery("#edit-new-1").insertAfter(".all-new-videos");
}

// function commentBox() {
//   jQuery('.comment-form.title.comment-title').click(function() {
//     if(jQuery(window).width() < 700) {
//       jQuery('div#comment-form').toggle('fast');
//       jQuery("#lightbox2-overlay").toggle();
//     }
//     else {
//       jQuery('div#comment-form').slideToggle('slow');
//     }
//   });
//   jQuery('div#comment-form button.close').click(function() {
//     jQuery('div#comment-form').toggle('fast');
//   });
// }


function toggleComments() {
    jQuery('.view-comment').bind('click', function() {
        jQuery(".node-statistics-comment").toggle();
        jQuery("#comments").toggle();
        jQuery(".view-comment").toggleClass("unpressed");
    });

    var url = window.location.href, idx = url.indexOf("#");
    // var hash = idx != -1 ? url.substring(idx+1) : "";
    if (idx != -1) {
        hash = url.substring(idx + 1);
        jQuery('.view-comment').click();
        // console.log('1');
        // Fixing scroll
        setTimeout(function() {
            // console.log('2');
            jQuery(window).scrollTop(jQuery(window).scrollTop() - jQuery(window).height() / 4 - 40);
        }, 100);
        // console.log('3');
    }
    else {
        hash = "";
    }
}

function popupModal(triggerLink, modalBlock) {
    jQuery(triggerLink).attr("href", "#");
    jQuery(triggerLink).click(function() {
        // Figure out height
        jQuery(modalBlock)
                .css({
            visibility: 'hidden',
            display: 'block'
        });
        var modalHeight = jQuery(modalBlock).height();
        jQuery(modalBlock)
                .css({
            visibility: 'visible',
            display: 'none'
        });
        //Center modal window
        jQuery(modalBlock).css("top", (jQuery(window).height() - modalHeight) / 2 - 10 + "px");
        // jQuery(modalBlock).css("top", (jQuery(window).height()-modalHeight)/2 + "px");
        jQuery(modalBlock).css("max-height", jQuery(window).height());
        jQuery(modalBlock).css("overflow", "auto");
        if (parseInt(jQuery(modalBlock).css("top")) < 0) {
            jQuery(modalBlock).css("top", "0");
        }
        jQuery(modalBlock).toggle();
        jQuery("#lightbox2-overlay").toggle();

        jQuery(window).resize(function() {
            jQuery(modalBlock).css("top", (jQuery(window).height() - modalHeight) / 2 - 10 + "px");
            // jQuery(modalBlock).css("top", (jQuery(window).height()-modalHeight)/2 + "px");
            jQuery(modalBlock).css("max-height", jQuery(window).height());
            if (parseInt(jQuery(modalBlock).css("top")) < 0) {
                jQuery(modalBlock).css("top", "0");
            }
        }); //Center modal window on resize

        // jQuery(modalBlock + " button.close").click(function() {
        //   jQuery(modalBlock + ", #lightbox2-overlay").toggle();
        // });
        // if (jQuery("#lightbox2-overlay").is(":visible") != true) {
        //   jQuery("#lightbox2-overlay").toggle();
        // }
    });

    jQuery(modalBlock + " button.close").bind('click', function() {
        jQuery(modalBlock).hide();
        jQuery("#lightbox2-overlay").hide();
    })

    jQuery("#lightbox2-overlay").click(function() {
        jQuery("button.close").trigger('click');
        jQuery("ul.menu").hide();
    });

    // jQuery(window).resize(function() {
    // menuMobile();
    // setFeatHeightPatch();
    // });
}
function menustripMobile(){
    jQuery("#menu-strip-name").click(function() {
      jQuery(".post-menu-strip").toggle();
  });
}
function menuMobile() {
    jQuery("#block-menu-menu-main-menu-mobile > ul.menu,#block-menu-menu-main-menu-mobile-ops > ul.menu,#block-menu-menu-main-menu-mobile-bto > ul.menu,#block-menu-menu-main-menu-mobile-it > ul.menu,#block-menu-menu-main-menu-mobile-ndm > ul.menu,#block-menu-menu-main-menu-mobile-entre > ul.menu,#block-menu-menu-main-menu-mobile-compete > ul.menu,#block-menu-menu-global-mobile-menu > ul.menu, .mobile-nav > ul.menu").css("max-height", jQuery(window).height() - 40);
    //jQuery(".mobile-menu-common > ul.menu").css("max-height", jQuery(window).height() - 40);
    jQuery(window).resize(function() {
        jQuery("#block-menu-menu-main-menu-mobile > ul.menu,#block-menu-menu-main-menu-mobile-ops > ul.menu,#block-menu-menu-main-menu-mobile-bto > ul.menu,#block-menu-menu-main-menu-mobile-it > ul.menu,#block-menu-menu-main-menu-mobile-ndm > ul.menu,#block-menu-menu-main-menu-mobile-entre > ul.menu,#block-menu-menu-main-menu-mobile-compete > ul.menu,#block-menu-menu-global-mobile-menu > ul.menu, .mobile-nav > ul.menu").css("max-height", jQuery(window).height() - 40);
        //jQuery(".mobile-menu-common > ul.menu").css("max-height", jQuery(window).height() - 40);
    });

    // jQuery("#block-menu-menu-main-menu-mobile ul.menu").hide();
    jQuery("li.expanded").toggleClass("collapsed");
    jQuery("li.expanded").toggleClass("expanded");

    jQuery("#menu-bar .nav-btn").click(function() {
        //jQuery(".mobile-menu-common > ul.menu").slideToggle("fast");
        jQuery("#block-menu-menu-main-menu-mobile > ul.menu,#block-menu-menu-main-menu-mobile-ops > ul.menu,#block-menu-menu-main-menu-mobile-bto > ul.menu,#block-menu-menu-main-menu-mobile-it > ul.menu,#block-menu-menu-main-menu-mobile-ndm > ul.menu,#block-menu-menu-main-menu-mobile-entre > ul.menu,#block-menu-menu-main-menu-mobile-compete > ul.menu, #block-menu-menu-global-mobile-menu > ul.menu").slideToggle("fast");
        jQuery(".mobile-nav > ul.menu").hide();
        jQuery("#lightbox2-overlay").toggle();
    });
        jQuery("#block-block-36 .nav-btn").click(function() {
        //jQuery(".mobile-menu-common > ul.menu").slideToggle("fast");
        jQuery(".mobile-nav > ul.menu").slideToggle("fast");
        jQuery("#lightbox2-overlay").toggle();
      //  jQuery("#menu-bar .nav-btn").toggle();
    });

    jQuery("li.collapsed > a").attr({'href': '#'});
    jQuery("li.collapsed").click(function() {
        // jQuery(e).stopPropagation();
        jQuery("ul.menu", jQuery(this)).slideToggle("fast");
        jQuery("ul.menu", jQuery(this)).css("z-index", "2000");
        jQuery(this).toggleClass("expanded");
        jQuery(this).toggleClass("collapsed");
    });

    // jQuery("li.expanded ul.menu li a").on('click', function(e){
    //   e.stopPropagation();
    // });
}

function carousel() {
    var html = [];
    var ctr = 0;
    var lidiv = '';
    var htmldiv = [];
    var mainctr = 1;
    jQuery('.menu-item-521 > a').attr({'target': '_blank'});
//          jQuery('.menu-item-934 > a').attr({'target': '_blank'});
//  none of the main menu seems to be open in new widow since the resource link is not there
//    jQuery('#block-menu-menu-main-menu-mobile .menu .menu-depth-1.last > a,#block-menu-menu-main-menu-mobile-ops .menu .menu-depth-1.last > a,#block-menu-menu-main-menu-mobile-bto .menu .menu-depth-1.last > a,#block-menu-menu-global-mobile-menu .menu .menu-depth-1.last > a, .mobile-nav .menu .menu-depth-1.last >a').attr({'target': '_blank'});
    //jQuery('.mobile-menu-common .menu .menu-depth-1.last > a').attr({'target': '_blank'});
    jQuery('#edit-tid-wrapper .bef-select-as-links').find('.form-item div').each(function() {
        if (mainctr % 3 == 0) {
            lidiv += jQuery(this).html();
            htmldiv.push('<li>' + lidiv + '</li>');
            lidiv = '';
        }
        else {
            lidiv += jQuery(this).html();
        }
        mainctr++;
    });

    if (lidiv != '') {
        htmldiv.push('<li>' + lidiv + '</li>');

    }
    // htmldiv = '<ul>'+htmldiv+'</ul>';
//      startPosition =
    jQuery('#edit-tid-wrapper .bef-select-as-links').children().replaceWith('<ul>' + htmldiv.join('') + '</ul>');
    jQuery('.bef-select-as-links ul').addClass('jcarousel-skin-default');
    jQuery('.bef-select-as-links ul').attr('id', 'tags-custom-carousel');
    var data = jQuery('#tags-custom-carousel').jcarousel({
        // scroll : 3
//            itemVisibleOutCallback: {onAfterAnimation: mycarousel_itemVisibleOutCallback},
//            itemVisibleInCallback: {onAfterAnimation: mycarousel_itemVisibleInCallback}
    });

    // var tagul = jQuery('#edit-tid-wrapper .bef-select-as-links').children();
//    tagul.each(function() {
    //        html.push('<ul>' + jQuery(this).html() + '</ul>');
//    }); tagul.replaceWith(html.join(''));
//     //jQuery('#edit-tid-wrapper .bef-select-as-links').children().wrap('<ul class="ultest" />');
//    jQuery('#edit-tid-wrapper .form-type-bef-link').wrap('<li class="litest" />');
//    var getclass = jQuery('.bef-select-as-links ul');
//      getclass.addClass('jcarousel-skin-default');
//      getclass.attr('id', 'tags-custom-carousel');
//
//    jQuery('#tags-custom-carousel').jcarousel({});
}

function activetag() {
    var url = window.location.href;
    jQuery('.jcarousel-list a[href="' + url + '"]').addClass('active-tag');

}

function trigger() {
//    var index = carousel.index(carousel.last, size of list);
//    return index;
    // var position = jQuery('.active-tag');
    // var actual = carousel.first;
    // return actual;
    var position = jQuery('.active-tag').parent().attr('jcarouselindex');
    jQuery('#tags-custom-carousel').jcarousel({
        // 'scroll' : parseInt(position),
        start: parseInt(position)
    });
    //  jQuery('#tags-custom-carousel').jcarousel(
    //  {
    //    start : parseInt(position)
    // });
    //jQuery('#tags-custom-carousel').jcarousel('reload');
}

function resetHiddenFieldValue() {
    jQuery('#edit-submit-listing-by-tags').click(function() {
        var hd = jQuery("input[name='q'][type='hidden']").val();
        if (hd != 'tags') {
            jQuery("input[name='q'][type='hidden']").val('tags');
        }

    });

}
function addRemoveBorder() {
    jQuery('#block-system-main-menu li.active-trail').prev('li').addClass('remove-border');
}

function addNewsletterClass() {

    jQuery('#simplenews-subscriptions-page-form .form-item-newsletters-51, #simplenews-subscriptions-page-form .form-item-newsletters-52, #simplenews-subscriptions-page-form .form-item-newsletters-53, #simplenews-subscriptions-page-form .form-item-newsletters-54').addClass('newsletter-frequency');
    jQuery('.newsletter-frequency').wrapAll('<div class="fequency" />');
    jQuery('#simplenews-subscriptions-page-form .form-item-newsletters-4').addClass('all-new-videos');


}


function changeCheckBoxToRadio() {
    jQuery('#simplenews-subscriptions-page-form .fequency [type=checkbox]').each(function() {
        var self = jQuery(this);
        jQuery(this).replaceWith(
                jQuery('<input type="radio" />').
                prop("value", self.prop("value")).
                prop("name", self.prop("name")).
                prop("id", self.prop("id")).
                prop("class", self.prop('class')).
                prop("checked", self.prop('checked'))
                );
        // jQuery(this).prop('type', 'radio').
        //   attr("value", self.attr("value")).
        //   attr("name", self.attr("name")).
        //   attr("id", self.attr("id")).
        //   attr("class", self.attr('class')).
        //   attr("checked", self.attr('checked'));
    });
}

function uncheckRadio() {
    jQuery('#simplenews-subscriptions-page-form .fequency [type=radio]').click(function() {
        jQuery('#simplenews-subscriptions-page-form .fequency [type=radio]').removeAttr("checked");
        jQuery(this).attr("checked", "checked");
    });
}

function checkedAllCategory() {
    var not_checked = ["edit-newsletters-51", "edit-newsletters-52", "edit-newsletters-53", "edit-newsletters-54", "edit-newsletters-50", "edit-newsletters-4"];

    jQuery('input.form-checkbox').each(function() {
        var id = jQuery(this).attr('id');
        if (jQuery.inArray(id, not_checked) != -1) {
            // alert(id+' find element');
        } else {
            jQuery(this).addClass('newsletter-category');
        }

    });

    jQuery('#edit-newsletters-4').click(function() {
        if (jQuery(this).attr("checked")) {
            //checked and disabled
            jQuery(".newsletter-category").attr("checked", "checked");

        } else {
            //unchecked and enable
            jQuery('.newsletter-category').removeAttr("checked");

        }
    });
    //uncheck all video checkbox when any category is checked
    jQuery('.newsletter-category').click(function() {
        if (jQuery('.newsletter-category').attr('checked') == true) {
            jQuery('#edit-newsletters-4').attr('checked', '');
            //}
        }

    });
}

function defaultText() {
    (function($) {
        //$("#edit-name-wrapper #edit-name").attr('title','Tag Or Author');

        $("#edit-name-wrapper #edit-name").focus(function()
        {
            if ($(this).val() == $(this)[0].title)
            {
                $(this).removeClass("defaultTextActive");
                $(this).val("");
            }
        });

        $("#edit-name-wrapper #edit-name").blur(function()
        {
            if ($(this).val() == "")
            {
                $(this).addClass("defaultTextActive");
                $(this).val($(this)[0].title);
            }
        });

        $("#edit-name-wrapper #edit-name").blur();

//focus for search box

        $("#edit-search-block-form--2").focus(function()
        {
            if ($(this).val() == $(this)[0].title)
            {
                $(this).removeClass("defaultTextActive");
                $(this).val("");
            }
        });

        $("#edit-search-block-form--2").blur(function()
        {
            if ($(this).val() == "")
            {
                $(this).addClass("defaultTextActive");
                $(this).val($(this)[0].title);
            }
        });

        $("#edit-search-block-form--2").blur();



    })(jQuery);
}
// Drupal.behaviors.externalMenu = function(context, settings) {
//     jQuery('.menu-item-521 > a').attr({'target': '_blank'});
// };


function addLabel() {
    jQuery('.form-item-newsletters-457,.form-item-newsletters-455,.form-item-newsletters-456,.form-item-newsletters-609,.form-item-newsletters-610,.form-item-newsletters-611,.form-item-newsletters-612').after('<h5 class="category_label">ONLY new videos added to these categories</h5>');
}

function toogleSearch() {
//  jQuery(function(){jQuery('#block-search-form').hide();})
    jQuery('.mobile-search').bind('click', function() {
        window.scrollTo(0, 0);
        jQuery("#block-search-form").toggle();
        jQuery(".mobile-search").toggleClass("unpressed");
    });
}
function tooglechild() {
        //$('.applytoggle_title, .block-tellafriend').click(function() {
        //jQuery('#block-views-child-library-block-block-2, #block-views-child-library-block-block-5').toggle();
        //jQuery('#block-views-child-library-block-block-4, #block-views-child-library-block-block-1').toggle();
        //jQuery('#block-views-child-library-block-block, #block-views-child-library-block-block-3').toggle();
}
function suggestLink() {
if(jQuery("#suggest-link").text()=="How to Suggest a Video") {
    jQuery("#suggest-link").attr('href','#');
 jQuery("#suggest-link").click(function() {
        alert('We appreciate your suggestions of new videos to add to the library. To suggest a video, go to the relevant page using the library selector, and click on "Suggest a Video".');});
}
}
// function checkChildCategory() {
//     jQuery('.form-item-newsletters-457').on('click', function (e) {
//      if (e.target.className == "#bto-newsletter") {
//          var cnt = jQuery('input[type="checkbox"]:checked').length;
//          var cntSel = jQuery('select').val();
//          var fin = cntSel - cnt;
//          jQuery(this).find('input[type="checkbox"]:lt(' + fin + ')').prop('checked', true);
//      }
//  });
// }

function checkChildCategory() {
    var blocks = jQuery(".newsletter-block");
    blocks.each(function() {
        var _parentthis = jQuery(this);
        _parentthis.find(".form-type-checkbox:first-child input").click(function() {
          var $this = jQuery(this);
          if($this.is(":checked")) {
            _parentthis.find(".form-type-checkbox input").attr("checked", "checked");
          }
          else {
            _parentthis.find(".form-type-checkbox input").removeAttr("checked");
          }
        });
    });
}
