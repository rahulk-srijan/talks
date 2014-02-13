<?php

/*
 * imp hook_preprocess_page
 *
 */
global $subsite_home_page_url;

$library_array = array('orginaction', 'opsinaction', 'btoacademy');
$argument = explode('/', request_path());
if (in_array($argument[0], $library_array)) {
    $subsite_home_page_url = strtolower($argument[0]);
}

function vl_preprocess_html(&$vars) {
    global $subsite_home_page_url;
    drupal_add_css(drupal_get_path('theme', 'vl') . '/css/global.base.IE8.css', array(
        'group' => CSS_THEME,
        'browsers' => array(
            'IE' => 'lte IE 8',
            '!IE' => FALSE
        ),
        'preprocess' => FALSE
    ));
    drupal_add_css(drupal_get_path('theme', 'vl') . '/css/global.styles.IE8.css', array(
        'group' => CSS_THEME,
        'browsers' => array(
            'IE' => 'lte IE 8',
            '!IE' => FALSE
        ),
        'preprocess' => FALSE
    ));
    drupal_add_css(drupal_get_path('theme', 'vl') . '/css/styles.IE8.css', array(
        'group' => CSS_THEME,
        'browsers' => array(
            'IE' => 'lte IE 8',
            '!IE' => FALSE
        ),
        'preprocess' => FALSE
    ));

    drupal_add_css(drupal_get_path('theme', 'vl') . '/css-color/' . $subsite_home_page_url . '--color.css', array(
        'group' => CSS_THEME,
        'preprocess' => FALSE,
        'type' => 'file',
    ));
    $current_url = explode("/", request_path());
    if (($current_url[0] == $subsite_home_page_url) && (empty($current_url[1]))) {
        $vars['classes_array'][] = 'home-child body-'.$subsite_home_page_url;
    }
    if (($current_url[0] == $subsite_home_page_url) && (!empty($current_url[1]))) {
        $vars['classes_array'][] = 'body-'.$subsite_home_page_url;
    }
    if ($current_url[1] == "browse") {
        $vars['classes_array'][] = 'page-browse';
    }
    if ($current_url[1] == "tags") {
        $vars['classes_array'][] = 'page-tags';
    }
}

function vl_preprocess_page(&$vars) {
    global $subsite_home_page_url;

    if (isset($_GET['q'])) {

        $current_url = explode("/", request_path());
        //print_r($current_url);
        if (($current_url[0] == $subsite_home_page_url) && (empty($current_url[1]))) {
            unset($_SESSION['browse_page']);
            $_SESSION['home_page'] = $subsite_home_page_url;
        } elseif ($current_url[1] == 'browse') {
            unset($_SESSION['home_page']);
            $_SESSION['browse_page'] = 'browse_page';
        } elseif ($current_url[1] == 'my-playlist') {
            unset($_SESSION['home_page']);
            unset($_SESSION['browse_page']);
        } elseif ($current_url[1] == 'newsletter') {
            unset($_SESSION['home_page']);
            unset($_SESSION['browse_page']);
        }
    }


//show recent comment and featured videos on home page
    togglehomepage();
}

function togglehomepage() {
    global $subsite_home_page_url;
    if (isset($_SESSION['home_page']) && ($_SESSION['home_page'] == $subsite_home_page_url)) {
        //show recent comment and featured videos on home page
        $url = url($subsite_home_page_url);
        drupal_add_js('
jQuery(document).ready(function () {
jQuery("#block-views-featured-vedios-block").show();
jQuery("#block-views-comments-recent-block").show();
jQuery("#block-views-views-by-category-block .view-all").addClass("homepage_link");
jQuery("#block-views-views-by-category-block .homepage_link a").attr("href","' . $url . '");
jQuery(".main_menu_across li.menu-item-218 a").addClass("active");
jQuery(".main_menu_across li.menu-item-2259 a").addClass("active");
jQuery(".main_menu_across li.menu-item-2264 a").addClass("active");


  });', 'inline');
    } else {

        drupal_add_js('
jQuery(document).ready(function () {
jQuery("#block-views-featured-vedios-block").hide();
jQuery("#block-views-comments-recent-block").hide();
jQuery("#block-views-views-by-category-block").removeClass("homepage_link");
jQuery(".main_menu_across li.menu-item-218 a").removeClass("active");
jQuery(".main_menu_across li.menu-item-519 a").removeClass("active");

jQuery(".main_menu_across li.menu-item-2259 a").removeClass("active");
jQuery(".main_menu_across li.menu-item-2260 a").removeClass("active");

jQuery(".main_menu_across li.menu-item-2264 a").removeClass("active");
jQuery(".main_menu_across li.menu-item-2265 a").removeClass("active");


  });', 'inline');
    }
    //highlight playlist browse
    if (isset($_SESSION['browse_page'])) {
        drupal_add_js('
jQuery(document).ready(function () {
jQuery(".main_menu_across li.menu-item-519 a").addClass("active");
jQuery(".main_menu_across li.menu-item-2260 a").addClass("active");
jQuery(".main_menu_across li.menu-item-2265 a").addClass("active");

  });', 'inline');
    }
    //highlight playlist menu
    if (arg(1) == 'playlist' && arg(1) == 'edit') {
        drupal_add_js('
jQuery(document).ready(function () {
jQuery(".main_menu_across li.menu-item-520 a").addClass("active");

  });', 'inline');
    }
}

function vl_preprocess_node(&$vars) {
    unset($vars['content']['links']['statistics']['#links']['statistics_counter']['title']);
    //echo "<pre>";print_r($vars['type']);die();
    if ($vars['type'] == "upload_video") {
        drupal_add_js('
jQuery(document).ready(function () {
jQuery(".main_menu_across li.menu-item-519 a").addClass("active");
jQuery(".main_menu_across li.menu-item-218 a").removeClass("active");

jQuery(".main_menu_across li.menu-item-2260 a").addClass("active");
jQuery(".main_menu_across li.menu-item-2259 a").removeClass("active");

jQuery(".main_menu_across li.menu-item-2265 a").addClass("active");
jQuery(".main_menu_across li.menu-item-2264 a").removeClass("active");
  });', 'inline');
    }

    unset($_SESSION['home_page']);
    if (!isset($_SESSION['browse_page'])) {
        $_SESSION['browse_page'] = 'browse_page';
    }
}

function mck_user_profile($uid) {
    $account = user_load($uid);
    $vendor_query = db_select('field_data_field_vendor_id', 'v')
            ->fields('v')
            ->condition('entity_id', $uid, '=')
            ->execute()
            ->fetchAssoc();
    $vendor_id = $vendor_query['field_vendor_id_value'];
    $role = 'contractor';
    if (in_array($role, array_values($account->roles)) || $uid == '-20') {
        $profile_url = "http://home.intranet.mckinsey.com/ks/research/home/welcome";
    } else {
        $profile_url = "http://home.intranet.mckinsey.com/profiles/people/" . $vendor_id;
    }
    return $profile_url;
}

//}


function mck_user_profile1($name) {

    $account = user_load_by_name(check_plain($name)); // (array('name' => check_plain('Lu Zhang')));

    if ($account->field_vendor_id['und']) {
        $vendor_id = $account->field_vendor_id['und'][0]['value'];

        $profile_url = "http://home.intranet.mckinsey.com/profiles/people/" . $vendor_id;
    } else {
        //$vendor_id = $account->uid;
        $profile_url = 'http://home.intranet.mckinsey.com/ks/research/home/welcome'; //"http://home.intranet.mckinsey.com/user/" . $vendor_id;
    }

    return $profile_url;
}

function vl_form_comment_form_alter(&$form, &$form_state) {
    $form['comment_body']['#prefix'] = '<button type="button" class="close">&times;</button>';
}

/**
 * override apache search noresults
 */
function vl_apachesolr_search_noresults() {
    return t('<ul>
        <li><strong>No results were found for that search term.</strong></li>
        <li>&nbsp;</li>
<li>Check if your spelling is correct, or try removing filters.</li>
<li>Remove quotes around phrases to match each word individually: <em>"blue drop"</em> will match less than <em>blue drop</em>.</li>
<li>You can require or exclude terms using + and -: <em>big +blue drop</em> will require a match on <em>blue</em> while <em>big blue -drop</em> will exclude results that contain <em>drop</em>.</li>
</ul>');
}