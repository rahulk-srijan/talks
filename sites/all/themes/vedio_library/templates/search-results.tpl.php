<?php
/**
 * @file
 * Default theme implementation for displaying search results.
 *
 * This template collects each invocation of theme_search_result(). This and
 * the child template are dependent to one another sharing the markup for
 * definition lists.
 *
 * Note that modules may implement their own search type and theme function
 * completely bypassing this template.
 *
 * Available variables:
 * - $search_results: All results as it is rendered through
 *   search-result.tpl.php
 * - $module: The machine-readable name of the module (tab) being searched, such
 *   as "node" or "user".
 *
 *
 * @see template_preprocess_search_results()
 */
drupal_add_css(drupal_get_path('module', 'apachesolr_extend') . '/css/apachesolr_extend.css', array('group' => CSS_DEFAULT, 'every_page' => FALSE));
drupal_add_js(drupal_get_path('module', 'apachesolr_extend') . '/js/jquery.imagesloaded.min.js', array('group' => JS_THEME, 'every_page' => FALSE));
drupal_add_js(drupal_get_path('module', 'apachesolr_extend') . '/js/jquery.infinitescroll.min.js', array('group' => JS_THEME, 'every_page' => FALSE));
drupal_add_js(drupal_get_path('module', 'apachesolr_extend') . '/js/infinitescroll.js', array('group' => JS_THEME, 'every_page' => FALSE));
$search_key = arg(2);
$total = $GLOBALS['pager_total_items'][0];
?>
<?php if ($total >0): ?>
    <ol class="search-results <?php print $module; ?>-results">
        <li class="result-found"><p>Results for <strong class="search-key">"<?php print $search_key; ?>"</strong> / <?php print $total; ?> Results found</p></li>
     <div class="category-filter-toggle">
    <div class="filter-search-facet">
	Filter</div><span class="filter-pipe">|</span>
<div class="date-search-facet">
	Sort</div> </div>
            <?php print $search_results; ?>
    </ol>
    <?php print $pager; ?>
<?php else : ?>
    <h2><?php print t('Your search yielded no results'); ?></h2>
    <?php print search_help('search#noresults', drupal_help_arg()); ?>
<?php endif; ?>