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
    if(function_exists('get_node_type')) {
        $node_type = get_node_type(arg(1));
    }
    $ch_tid = get_channel_tid_from_node(arg(1));
    if(function_exists('get_color_channel')) {
        $color = get_color_channel($ch_tid);
    }
    
  print l($row->node_title,'node/'.$row->nid,array('attributes'=>array('style'=>'color:'.$color)));
?>
<?php //print $output; ?>