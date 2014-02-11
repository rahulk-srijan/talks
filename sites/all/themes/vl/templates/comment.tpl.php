<?php
/**
 * @file
 * Adaptivetheme implementation for the display of a single comment.
 *
 * Adaptivetheme variables:
 * AT Core sets special time and date variables for use in templates:
 * - $submitted: Submission information created from $name and $date during
 *   adaptivetheme_preprocess_comment(), uses the $created variable.
 * - $created: Formatted date and time for when the comment was created wrapped
 *   in a permalink, uses the $datetime variable.
 * - $datetime: datetime stamp formatted correctly to ISO8601.
 * - $header_attributes: attributes such as classes to apply to the header element.
 * - $footer_attributes: attributes such as classes to apply to the footer element.
 * - $links_attributes: attributes such as classes to apply to the nav element.
 * - $is_mobile: Bool, requires the Browscap module to return TRUE for mobile
 *   devices. Use to test for a mobile context.
 *
 * Available variables:
 * - $author: Comment author. Can be link or plain text.
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 *   Preprocess functions can reformat it by calling format_date() with the
 *   desired parameters on the $comment->created variable.
 * - $changed: Formatted date and time for when the comment was last changed.
 *   Preprocess functions can reformat it by calling format_date() with the
 *   desired parameters on the $comment->changed variable.
 * - $new: New comment marker.
 * - $permalink: Comment permalink.
 * - $picture: Authors picture.
 * - $signature: Authors signature.
 * - $status: Comment status. Possible values are:
 *   comment-unpublished, comment-published or comment-preview.
 * - $title: Linked title.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - comment: The current template type, i.e., "theming hook".
 *   - comment-by-anonymous: Comment by an unregistered user.
 *   - comment-by-node-author: Comment by the author of the parent node.
 *   - comment-preview: When previewing a new or edited comment.
 *   The following applies only to viewers who are registered users:
 *   - comment-unpublished: An unpublished comment visible only to administrators.
 *   - comment-by-viewer: Comment by the user currently viewing the page.
 *   - comment-new: New comment since last the visit.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * These two variables are provided for context:
 * - $comment: Full comment object.
 * - $node: Node object the comments are attached to.
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_comment()
 * @see template_process()
 * @see theme_comment()
 * @see adaptivetheme_preprocess_comment()
 * @see adaptivetheme_process_comment()
 *
 * Hiding Content and Printing it Separately:
 * Use the hide() function to hide fields and other content, you can render it
 * later using the render() function. Install the Devel module and use
 * <?php print dsm($content); ?> to find variable names to hide() or render().
*/
hide($content['links']); ?>
<div class="comment-list clearfix">
<div class="comment-author"><?php
$nid = $comment->cid;
//print_r($nid);
$commenter_uid= $content['comment_body']['#object']->uid;
// $vendor_query = db_select('field_data_field_vendor_id', 'v')
//   ->fields('v')
//   ->condition('entity_id',$commenter_uid,'=')
//   ->execute()
//   ->fetchAssoc();
// $vendor_id = $vendor_query['field_vendor_id_value'];
//$profile_url =  'http://home.intranet.mckinsey.com/profiles/people/' . $vendor_id;
$profile_url = mck_user_profile($commenter_uid);
print '<a href="' . $profile_url .'" target="_blank">' .render(check_plain($comment->name)).'</a>';?></div>
<div class="foramt-date"><?php
$formatted_time = format_date($comment->changed,'short');
print render($formatted_time); ?></div>
<div class="comment-content"><?php print nl2br(render($content['comment_body'])); ?></div>
<div class="links"><?php print render($content['links']);?></div>
</div>













