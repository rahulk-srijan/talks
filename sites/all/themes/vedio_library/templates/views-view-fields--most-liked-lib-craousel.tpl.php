<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>

<?php
global $base_url;
 //echo"<pre>";print_r($base_url);

if ($row->tid == 455)
	$class = "color-orange";
else if($row->tid == 456)
	$class="color-magenta";
else if($row->tid == 457)
	$class = "color-purple";
else if($row->tid == 591)
  $class = "color-yellow";
else if($row->tid == 592)
  $class = "color-bright-blue";
else if($row->tid == 602)
  $class = "color-entre";
else if($row->tid == 603)
  $class = "color-compete";
else
	$color ="color-default";
?>

<h4 class="lib-title lib-title-<?php print $class;?>">
  <a href="<?php print $base_url .'/'. $row->taxonomy_term_data_name; ?>"><?php print $row->taxonomy_term_data_description;?></a></h4>
<div class="library-item hargun library-<?php print $class;?>">
<?php foreach ($fields as $id => $field): ?>
  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>

  <?php print $field->wrapper_prefix; ?>
    <?php print $field->label_html; ?>
    <?php print $field->content; ?>
  <?php print $field->wrapper_suffix; ?>
<?php endforeach; ?>
</div>
