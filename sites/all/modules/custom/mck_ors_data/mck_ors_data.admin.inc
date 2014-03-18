<?php
/**
* @file
* Administration page callbacks for the mck_custom module.
*/


/**
* Form builder. ORS data Update form.
*/
function mck_ors_data_ors_data_page($update_people_form, $settings_form) {
  $output[$settings_form] = drupal_get_form($settings_form);
  $output[$update_people_form] = drupal_get_form($update_people_form);
  return $output;
}


/**
 * Build people update form.
 */
function mck_ors_data_ors_data_update_people_form($node, &$form_state) {
  $form = array();
  $form['action'] = array(
    '#type' => 'fieldset',
    '#title' => t('Update or Create or Delete People'),
    '#collapsible' => TRUE,
  );

  $form['action']['ors_data_birthday'] = array(
    '#type' => 'submit',
    '#value' => t('Update or Create or Delete People'),
    '#submit' => array('mck_ors_data_ors_data_update_people_submit'),
  );
  return $form;
}


/**
 * People submit handler.
 */
function mck_ors_data_ors_data_update_people_submit($form, &$form_state){
  mck_ors_data_get_people();
}


/**
 * Create ORS authentication form.
 */
function mck_ors_data_ors_data_settings_form($node, &$form_state) {
  $form['settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Settings'),
    '#collapsible' => TRUE,
  );
  $form['settings']['ors_database_username'] = array(
    '#type' => 'textfield',
    '#title' =>  t('Username'),
    '#size' => 60, 
    '#maxlength' => 128, 
    '#required' => TRUE,
    '#description' => t('ORS Database Username'),
    '#default_value' => variable_get('ors_database_username', 'username'),
 
  );
  $form['settings']['ors_database_password'] = array(
    //'#type' => 'password',
    '#type' => 'textfield',
    '#title' =>  t('Password'),
    '#size' => 60, 
    '#maxlength' => 128, 
    '#description' => t('ORS Database Password'),
    '#default_value' => variable_get('ors_database_password', 'password'),
  );
  $form['settings']['ors_database_connection_string'] = array(
    '#type' => 'textfield',
    '#title' =>  t('Easy Connect String'),
    '#size' => 60, 
    '#maxlength' => 128, 
    '#required' => TRUE,
    '#description' => t('ORS Database Easy Connect string. Easy connect string have the <i>[//]host_name[:port][/service_name][:server_type][/instance_name]</i> format. See !url detail about Easy connect string.', array('!url' => '<a href="http://php.net/manual/en/function.oci-connect.php">'. t('oci_connect') .'</a>')),
    '#default_value' => variable_get('ors_database_connection_string', '//hostname:port/service_name:server_type/instance_name'), 
  );
  return system_settings_form($form, TRUE);
}
