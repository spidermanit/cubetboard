<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Loads the configurations from the database
 *
 **/
class Site_configurations{

 /**
  * __construct
  *
  * @return void
  **/
 public function __construct()
 {
  $this->ci =& get_instance();

  
  $this->ci->load->model('admin_model');
  $settings = $this->ci->admin_model->getSiteSettings();

  //add settings to site config
  foreach($settings as $key => $setting)
  {
   $this->ci->config->set_item($key, $setting);
  }
 }

}