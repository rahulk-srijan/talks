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
?>
<?php
$nid = $row->nid;
$raw_node= 'node/'.$nid;
$path_alias = drupal_lookup_path('alias',$raw_node);
$host= $_SERVER['HTTP_HOST'];
$node_title = $field->original_value;
if($host == 'dev-utility-lx21.amdc.mckinsey.com'){
  print '<a href="http://devhome.intranet.mckinsey.com/globalcomm/VideoLibraryD7/'.$path_alias.'">'.$node_title.' </a>';
}
if($host == 'videolibraryqa.intranet.mckinsey.com'){
  print '<a href="http://qahome.intranet.mckinsey.com/orginaction/'.$path_alias.'"> '.$node_title.'</a>';
}
if($host == 'videolibraryint.intranet.mckinsey.com'){
  print '<a href="http://devhome.intranet.mckinsey.com/orginaction/'.$path_alias.'">'.$node_title.'</a>';
}
if($host == 'videolibrary.intranet.mckinsey.com'){
  print '<a href="http://home.intranet.mckinsey.com/orginaction/'.$path_alias.'">'.$node_title.'</a>';
}
?>
