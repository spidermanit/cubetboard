<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
User controller for other users page view

* @package pinterest clone controller
* @subpackage
* @uses : To handle the other users pages
* @version $id:$
* @since 13-04-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class User extends CI_Controller {


    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}
    /**
     * Function load the the user page from the user id
     * @param   : $id
     * @author  : Vishal
     * @since   : 13-04-2012
     * @return
     */
     public function index($id)
	 {        
        if($id)
             $data['id'] = $id; // user id
        else
            redirect(); // no user for given id load the home page

        $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id
        $data['title']          = $userDetails['name'];
        if(empty ($userDetails))
            redirect();
        
        $this->load->view('home', $data);
	 }
}
/* End of file user.php */
/* Location: ./application/controllers/user.php */