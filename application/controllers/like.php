<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
Like controller to handles the likes of a user

* @package pinterest clone controller
* @subpackage
* @uses : To handle all the like of a user
* @version $id:$
* @since 03-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Like extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}

    /**
     * Function display all likes of a user
     * @param  : <Int> $id
     * @author : Vishal
     * @since  : 03-05-2012
     * @return
     */
     public function index($id=false)
	 {
         $data['title']          = "Like";
         $data['id']             = ($id)?$id:$this->session->userdata('login_user_id');//logged user id
         $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id

         if(empty ($userDetails))
            redirect();

         $this->load->view('like_view',$data);
     }
}
/* End of file like.php */
/* Location: ./application/controllers/like.php */