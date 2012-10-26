<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
  Edit the notification page of a user email
* @package pinterest clone controller
* @subpackage
* @uses : To handle edit the notification page of a user email
* @version $id:$
* @since 19-03-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Notifications extends CI_Controller {

     function __construct()
	 {
		parent::__construct();
        $this->sitelogin->entryCheck();
	 }

    /**
     * Function to edit the notification page of a user email
     * @param
     * @author : Vishal
     * @since  : 19-03-2012
     * @return
     */
     public function index()
	 {
        $this->load->helper('pinterest_helper');
        //get reference and reference id
        $referenceId    = $this->session->userdata('referenceId');
        $reference      = $this->session->userdata('reference');

        //get current email
        $neededValue    = 'email';
        $data['email']  = getUserDetails($referenceId,$reference,$neededValue);

        //get current email settings
        $this->load->model('editprofile_model');
        $row = $this->editprofile_model->emailSettingDetails($data['email']);

        if(!empty($row))
        {
            //assign checked or not checked
            foreach($row as $key=>$value)
            {   if(($key!='frequency')&&($key!='email'))
                $data[$key] = ($value=='on')?'checked=checked':'';
                if($key=='frequency')
                {   if($value==1)
                    {
                        $data['frequency_1'] = 'checked=checked';
                        $data['frequency_2'] = '';
                    }
                    elseif($value==2)
                    {
                        $data['frequency_1'] = '';
                        $data['frequency_2'] = 'checked=checked';
                    }
                }
            }
        }
        else{
            $data['all'] = $data['group_pins'] = $data['comments'] = $data['likes'] = $data['repins'] = $data['follows'] = $data['frequency_1'] = $data['frequency_2'] = $data['digest'] = $data['news'] = '';
        }
        
		$this->load->view('notifications_view',$data);
	 }
     /**
      * Function to save the email settings for a user . Email specific
      * @param
      * @author : Vishal
      * @since  : 19-03-2012
      * @return
      */
     function save()
     {
       unset($_POST['csrfmiddlewaretoken']);
       unset($_POST['submit']);
       $this->load->model('editprofile_model');
       //update array
       $dataArray  = array();
       $email      =  $dataArray['email']          = $this->input->post('email');
       $all        =  $dataArray['all']            = $this->input->post('all')?$this->input->post('all'):'off';
       $group_pins =  $dataArray['group_pins']     = $this->input->post('group_pins')?$this->input->post('group_pins'):'off';
       $comments   =  $dataArray['comments']       = $this->input->post('comments')?$this->input->post('comments'):'off';
       $likes      =  $dataArray['likes']          = $this->input->post('likes')?$this->input->post('likes'):'off';
       $repins     =  $dataArray['repins']         = $this->input->post('repins')?$this->input->post('repins'):'off';
       $follows    =  $dataArray['follows']        = $this->input->post('follows')?$this->input->post('follows'):'off';
       $frequency  =  $dataArray['frequency']      = $this->input->post('frequency');
       $digest     =  $dataArray['digest']         = $this->input->post('digest')?$this->input->post('digest'):'off';
       $news       =  $dataArray['news']           = $this->input->post('news')?$this->input->post('news'):'off';
       $this->editprofile_model->saveEmailSettings($dataArray,$email);
       redirect('/notifications');
       
     }
}
/* End of file notifications.php */
/* Location: ./application/controllers/notifications.php */