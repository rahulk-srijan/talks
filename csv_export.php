<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Root directory of Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
global $user;

//if(array_key_exists('3', $user->roles) || array_key_exists('4', $user->roles)){
$interval = (isset($_REQUEST['interval'])) ? intval($_REQUEST['interval']) : 0.5;
export($interval);

function generate_user_csv_export($interval = 0.5) {
  $key = 'csv-generate';
  $content = cache_get($key);
  $reload_tree = (isset($content->created)) ? csv_export_check_expire_time($content->created, $interval) : TRUE;
  if ($reload_tree == FALSE) { // If timeout has not happened check for data presence
    $data = $content->data;
    if ((empty($content->data))) {
      $reload_tree = TRUE;
    }
  }
  if ($reload_tree == TRUE) {
    $data = export_user_stat();
    cache_set($key, $data);
  }
  return $data;
}

function generate_video_csv_export($interval = 0.5,$tid) {
  $key = 'csv-generate2';
  $content = cache_get($key);
  $reload_tree = (isset($content->created)) ? csv_export_check_expire_time($content->created, $interval) : TRUE;
  if ($reload_tree == FALSE) { // If timeout has not happened check for data presence
    $data = $content->data;
    if ((empty($content->data))) {
      $reload_tree = TRUE;
    }
  }
  if ($reload_tree == TRUE) {
    $data = export_video_stat($tid);
    cache_set($key, $data);
  }
  return $data;
}

/**
 * Check the generation time in the cache
 * @param type $time_key
 * @param type $interval_hour
 * @return boolean
 */
function csv_export_check_expire_time($last_execution_time, $interval_hour = .2) {
  $elapsed_time = '';
  $allowed_difference = 60 * 60 * $interval_hour; // Reload at each 3 hour
  $reload_tree = FALSE;
  if (empty($last_execution_time)) {
    $reload_tree = TRUE;
  } else {
    $elapsed_time = time() - $last_execution_time;
    if ($elapsed_time >= $allowed_difference) {
      $reload_tree = TRUE;
    }
  }
  return $reload_tree;
}

/*
 * exoort user stat in a table
 */
function export_user_stat() {
    $users_comment_count = comment_number();
    $video_view_count = number_of_video_views();
    $result = db_query("SELECT DISTINCT users.name AS authmap_authname,
  users.uid AS uid, users.access AS users_access,
  users.created AS users_created, 'user' AS field_data_field_vendor_id_user_entity_type
  FROM {users} users
  WHERE (( (users.status <> '0') AND (users.uid > '3') )) ORDER BY users_created DESC");

    //   echo json_encode($result->fetchAll());
    //   exit;
    if (!$result)
        watchdog('export_user_stat', 'Exporting CSV: Not found user_stat in the database');
    //$num_fields = $result->rowCount();
    //$header = array(t('Authentication name'), t('No. of comments'), t('No. of videos viewed'), t('Last access'));
    // print_r(fetchAllAssoc($result));
    $content = '';
    $content .= '<table id="csvtable">
 <thead><tr><th>' . t('Authentication name') . '</th><th>' . t('No. of comments') . '</th><th>' . t('No. of videos viewed') . '</th><th>' . t('Last access') . '</th> </tr></thead>
<tbody>';


    foreach ($result as $row) {
        // $rows[] = array($row->authmap_authname, comment_number($row->uid), number_of_video_views($row->uid), date("m/d/Y", $row->users_access));
        $total_comments  = (isset($users_comment_count[$row->uid])) ? intval($users_comment_count[$row->uid]) : 0;
        $total_views = (isset($video_view_count[$row->uid])) ? intval($video_view_count[$row->uid]) : 0;
        $content .= '<tr><td>' . $row->authmap_authname . '</td><td>' . $total_comments . '</td><td>' . $total_views . '</td><td>' . date("m/d/Y", $row->users_access) . '</td> </tr>';
    }
    // print_r($rows);
    //$output = theme('table', array('header' => $header, 'rows' => $rows,  'sticky' => FALSE));
    //print $output;
    $content .= '<tbody></table>';
    return $content;
}

/*
 * exoort user stat in a table
 */

function export_video_stat($tid) {
  global $library_subsite_variable;
  $lib_tid = $library_subsite_variable[$tid][tid];
  $video_viewers_count = viewers();
  if($lib_tid){
    $result = db_query("SELECT node.title AS node_title, node.nid AS nid, node_counter.totalcount AS node_counter_totalcount, flag_counts_node.count AS flag_counts_node_count, node_comment_statistics.comment_count AS node_comment_statistics_comment_count, node.created AS node_created
FROM
{node} node
LEFT JOIN {flag_counts} flag_counts_node ON node.nid = flag_counts_node.content_id AND flag_counts_node.fid = '3'
LEFT JOIN {field_data_field_library} field_data_field_library ON node.nid = field_data_field_library.entity_id AND (field_data_field_library.entity_type = 'node' AND field_data_field_library.deleted = '0')
LEFT JOIN {node_counter} node_counter ON node.nid = node_counter.nid
INNER JOIN {node_comment_statistics} node_comment_statistics ON node.nid = node_comment_statistics.nid
WHERE (( (field_data_field_library.field_library_tid = :tid ) )AND(( (node.status = '1') AND (node.type IN  ('upload_video')) )))
ORDER BY node_created DESC", array(':tid' => $lib_tid));}
    else{
      $result = db_query("SELECT node.title AS node_title, node.nid AS nid, node_counter.totalcount AS node_counter_totalcount, flag_counts_node.count AS flag_counts_node_count, node_comment_statistics.comment_count AS node_comment_statistics_comment_count, node.created AS node_created
FROM
{node} node
LEFT JOIN {flag_counts} flag_counts_node ON node.nid = flag_counts_node.content_id AND flag_counts_node.fid = '3'
LEFT JOIN {node_counter} node_counter ON node.nid = node_counter.nid
INNER JOIN {node_comment_statistics} node_comment_statistics ON node.nid = node_comment_statistics.nid
WHERE (( (node.status = '1') AND (node.type IN  ('upload_video')) ))
ORDER BY node_created DESC");
    }

    if (!$result)
          watchdog('export_video_stat', 'Exporting CSV: Not found video_stat in the database');
    //$num_fields = $result->rowCount();
    $headers = array(t('Video'), t('Views'), t('Likes'), t('Comments'), t('Viewers'));


    // print_r(fetchAllAssoc($result));
    $content = '';
    $content .= '<table id="csvtable">
 <thead><tr><th>' . t('Video') . '</th><th>' . t('Views') . '</th><th>' . t('Likes') . '</th><th>' . t('Comment') . '</th> <th>' . t('Viewers') . '</th></tr></thead>
<tbody>';


    foreach ($result as $row) {
        // $rows[] = array($row->node_title, $row->node_counter_totalcount, $row->flag_counts_node_count, $row->node_comment_statistics_comment_count, viewers($row->nid));
        $total_viewers = (isset($video_viewers_count['node/' . $row->nid])) ? intval($video_viewers_count['node/' . $row->nid]) : 0;
        $content .= '<tr><td>' . $row->node_title . '</td><td>' . $row->node_counter_totalcount . '</td><td>' . $row->flag_counts_node_count . '</td><td>' . $row->node_comment_statistics_comment_count . '</td> <td>' . $total_viewers . '</td> </tr>';
    }
    // print_r($rows);
    //$output = theme('table', array('header' => $header, 'rows' => $rows,  'sticky' => FALSE));
    //print $output;
    $content .= '<tbody></table>';
    return $content;
}

function export($gitinterval = 0.5) {
    $q = $_GET['file'];
    $tid = $_GET['tid'];
    $file = $q.'-'.$tid. "-stats.xls";


    if ($q == 'user') {
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=$file");
        header("Pragma: no-cache");
        header("Expires: 0");
        $table_content = generate_user_csv_export($interval);
    } elseif ($q == 'video') {
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=$file");
        header("Pragma: no-cache");
        header("Expires: 0");
        $table_content = generate_video_csv_export($interval,$tid);
    } elseif ($q == 'table') {
        $table_content = generate_user_csv_export($interval);
    }

    echo $table_content;
    exit;
}

?>
