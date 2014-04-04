<?php
/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
//print_r($row->nid);
//
//
$video_uri = $row->field_field_upload_video[0]['raw']['uri'];
$video_file_name = $row->field_field_upload_video[0]['raw']['playablefiles'][0]->filename;
$root_path = $_SERVER['DOCUMENT_ROOT'];
$video_path = $root_path . '/sites/default/files/videos/original/' . $video_file_name;
//$video_duration = video_library_get_video_duration($video_uri);
//$get_nid= $row->nid;
//
//$video_duration = video_library_get_video_duration($get_nid);
?>
<?php print $output; ?>

<div class="play-button">
    <?php
    $node_path = $row->field_field_upload_video[0]['rendered']['#path']['path'];
    global $base_url;
    $node_path_alias = drupal_get_path_alias($node_path);
//print l(t("<img src=sites/all/themes/vedio_library/css/images/play_icon.png />"),$node_path_alias);
    print "<a href=" . $base_url . "/" . $node_path_alias . "><img src=" . $base_url . "/sites/all/themes/vedio_library/css/images/newplay.png /></a>";
    ?>
</div>
<!--
<div class="video_duration">
    <?php //print $video_duration; ?></div> --!>
