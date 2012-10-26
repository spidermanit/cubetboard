<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
Activity controller to handles the activities of a user

* @package pinterest clone controller
* @subpackage
* @uses : To handle all the activities of a user
* @version $id:$
* @since 03-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Activity extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}

    /**
     * Function display all activities of a user
     * @param  : <Int> $id
     * @author : Vishal
     * @since  : 03-05-2012
     * @return
     */
     public function index($id=false)
	 {
         $data['title']          = "Activity";
         $data['id']             = ($id)?$id:$this->session->userdata('login_user_id');//logged user id
         $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id
         if(empty ($userDetails))
            redirect();

         $this->load->view('activity_view',$data);
     }
     /**
     * Function display all activities of friends of a given user
     * @param  : <Int> $userId
     * @author : Vishal
     * @since  : 03-05-2012
     * @return
     */
     function latestFeeds($userId)
     {   $data['title']          = "Latest feeds";
         $data['id']             = ($userId)?$userId:$this->session->userdata('login_user_id');//logged user id
         $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id
         $this->load->view('followingsActivity_view',$data);
     }
}
/* End of file activity.php */
/* Location: ./application/controllers/activity.php */