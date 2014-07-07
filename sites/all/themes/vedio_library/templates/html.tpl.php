<?php
/**
 * @file
 * Adaptivetheme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Adaptivetheme Variables:
 * - $html_attributes: structure attributes, includes the lang and dir attributes
 *   by default, use $vars['html_attributes_array'] to add attributes in preprcess
 * - $polyfills: prints IE conditional polyfill scripts enabled via theme
 *   settings.
 * - $skip_link_target: prints an ID for the skip navigation target, set in
 *   theme settings.
 * - $is_mobile: Bool, requires the Browscap module to return TRUE for mobile
 *   devices. Use to test for a mobile context.
 *
 * Available Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 * @see adaptivetheme_preprocess_html()
 * @see adaptivetheme_process_html()
 */
global $base_url;
global $subsite_home_page_url;
?><!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7"<?php print $html_attributes; ?>><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7"<?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8"<?php print $html_attributes; ?>><![endif]-->
<!--[if IE 8]><html class="lt-ie9"<?php print $html_attributes; ?>><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html<?php print $html_attributes . $rdf_namespaces; ?>><!--<![endif]-->
<head>
  <?php if((isset($subsite_home_page_url)) && ($subsite_home_page_url == "btoacademy")) { ?>
    <link rel="shortcut icon" href="<?php print $base_url . '/' . path_to_theme() . '/favicon.ico' ?>" type="image/x-icon" />
  <?php }
    else {
   ?>
   <link rel="shortcut icon" href="<?php print $base_url . '/' . path_to_theme() . '/favicon2.ico' ?>" type="image/x-icon" />
   <?php } ?>

  <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
<?php print $head; ?>
<title><?php
global $subsite_home_page_url;
global $library_subsite_variable;
  // Adding conditions for page title tag
  if ($subsite_home_page_url && !arg(1)) {
    print "McKinsey Talks | " . $library_subsite_variable[$subsite_home_page_url]['site_name'];
  }
  elseif ($head_title_array["title"] && $subsite_home_page_url) {
    print $head_title_array["title"] . ' | ' . $library_subsite_variable[$subsite_home_page_url]['site_name'];
  }
  else {
    print $head_title;
  } ?>
</title>
<?php print $styles; ?>
<?php print $scripts; ?>

<?php print $polyfills; ?>
<!-- <link href='http://fonts.googleapis.com/css?family=Sanchez' rel='stylesheet' type='text/css'> -->
<!-- <link href='http://fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<div id='alertToCompatabilityMode' onclick='document.getElementById("alertToCompatabilityMode").style.display = "none"' style='height:30px;display:none;background-color:red;cursor:pointer;cursor:hand;'>
<font style='cursor:pointer;cursor:hand' color=white><p>This website is best viewed outside of <i>Compatibility Mode</i>.  Select <i>Tools</i> from the menu at the top of your browser and uncheck <i>Compatibility View</i> for the best experience. </p></font>
</div>

<script language='javascript'>
var userNav = navigator.userAgent;
var agent = userNav.toLowerCase();
if (agent.indexOf("msie 7.0") >= 1 && agent.indexOf("trident/4.0") >= 1 && navigator.platform.toLowerCase().indexOf("win") >= 0){
// IE 8 without compatability mode, on windows - platform likely redundant, but it insures random macs running IE aren't affected.  Fine to remove.
document.getElementById('alertToCompatabilityMode').style.display = "block";
}

// For IE 10 compatibility mode
var userNav = navigator.userAgent;
if (userNav.indexOf('Trident/6.0') >= 0 && userNav.indexOf('MSIE 7.0')>= 0) { /*display banner*/
	document.getElementById('alertToCompatabilityMode').style.display = "block";
}

</script>
<!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
    <script src="sites/all/themes/vedio_library/scripts/css3-mediaqueries.js"></script>

<!-- <script src="/sites/all/libraries/jwplayer/jwplayer.js"></script> -->
 <!--<script>jwplayer.key="Guox+nuMLWKTuNNNaAnBSWq9ep4UEQMc3m+a1A=="</script>-->
</head>
<body class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <div id="skip-link">
    <a href="<?php print $skip_link_target; ?>" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <div id="organisation-video-library-gallery">
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
    </div>
</body>
</html>
