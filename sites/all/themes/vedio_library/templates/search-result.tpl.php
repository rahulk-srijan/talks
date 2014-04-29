<?php
/**
 * @file
 * Default theme implementation for displaying a single search result.
 *
 * This template renders a single search result and is collected into
 * search-results.tpl.php. This and the parent template are
 * dependent to one another sharing the markup for definition lists.
 *
 * Available variables:
 * - $url: URL of the result.
 * - $title: Title of the result.
 * - $snippet: A small preview of the result. Does not apply to user searches.
 * - $info: String of all the meta information ready for print. Does not apply
 *   to user searches.
 * - $info_split: Contains same data as $info, split into a keyed array.
 * - $module: The machine-readable name of the module (tab) being searched, such
 *   as "node" or "user".
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Default keys within $info_split:
 * - $info_split['type']: Node type (or item type string supplied by module).
 * - $info_split['user']: Author of the node linked to users profile. Depends
 *   on permission.
 * - $info_split['date']: Last update of the node. Short formatted.
 * - $info_split['comment']: Number of comments output as "% comments", %
 *   being the count. Depends on comment.module.
 *
 * Other variables:
 * - $classes_array: Array of HTML class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $title_attributes_array: Array of HTML attributes for the title. It is
 *   flattened into a string within the variable $title_attributes.
 * - $content_attributes_array: Array of HTML attributes for the content. It is
 *   flattened into a string within the variable $content_attributes.
 *
 * Since $info_split is keyed, a direct print of the item is possible.
 * This array does not apply to user searches so it is recommended to check
 * for its existence before printing. The default keys of 'type', 'user' and
 * 'date' always exist for node searches. Modules may provide other data.
 * @code
 *   <?php if (isset($info_split['comment'])): ?>
 *     <span class="info-comment">
 *       <?php print $info_split['comment']; ?>
 *     </span>
 *   <?php endif; ?>
 * @endcode
 *
 * To check for all available data within $info_split, use the code below.
 * @code
 *   <?php print '<pre>'. check_plain(print_r($info_split, 1)) .'</pre>'; ?>
 * @endcode
 *
 * @see template_preprocess()
 * @see template_preprocess_search_result()
 * @see template_process()
 */
global $base_url;
?>
<li class="<?php print $classes . $row_no; ?>"<?php print $attributes; ?>>
    <?php print render($title_prefix); ?>

    <?php print render($title_suffix); ?>
    <div class="search-snippet-info">

        <div class="image-block">

            <?php
            $filename = drupal_realpath($video_thumbnail);
            if (file_exists($filename)) {
                $imgsrc = image_style_url('vedio_thumbnail', $video_thumbnail);
            } else {
                $imgsrc = $base_url . "/sites/all/themes/vedio_library/css/images/no-image.jpg";
            }
            ?>
            <div class="thumbnails"><a href="<?php print $url ?>"><img src ="<?php print $imgsrc; ?>" alt="" title="" /></a></div>
            <div class="play-button">
                <?php
                print "<a href=" . $url . "><img src=" . $base_url . "/sites/all/themes/vedio_library/css/images/play_icon.png /></a>";
                ?>
            </div>
            <?php if ($video_duration): ?>
                <div class="video-search-duration"><?php print $video_duration; ?></div>
            <?php endif; ?>
        </div>


        <?php if ($snippet): ?>
            <div class="search-snippet"<?php print $content_attributes; ?>>
                <a href="<?php print $url; ?>"><div class="video-title">
                    <span class="title"<?php print $title_attributes; ?>>
                        <?php print $title; ?>
                    </span>
                </div></a>
                <div class="snippet">  <?php print $snippet; ?></div>


                <?php if ($author): ?>
                    <div class="author">
                        <?php
                        $profile_url = mck_user_profile1($author);
                        print '<strong class="profile">Author: </strong><a href="' . $profile_url . '" target="_blank">' . $author . '</a>';
                        ?>
                    </div>
                <?php endif; ?>


                <?php if ($category): ?>
                    <div class="category-search"><strong>Category: </strong><?php print $category; ?></div>
                <?php endif; ?>


            <?php endif; ?>

        </div>
         <?php if ($bm_field_share){ ?>
                <div class="field_share"><?php print t('*Not client shareable'); ?></div>
         <?php } else { ?>
                <div class="field_share"></div>
         <?php } ?>
        <?php if ($number_of_like): ?>
            <div class="number_of_like"><?php print $number_of_like; ?></div>
        <?php endif; ?>
        <p style="display: none;"><?php print "like =" . $number_of_like . ' , comment_count =' . $comment_count . ',  total_node_views = ' . $total_node_views; ?></p>
    </div>
</li>
