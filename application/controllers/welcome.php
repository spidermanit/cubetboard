<?php
/**
Welcome controller for user invite and register

* @package pinterest clone controller
* @subpackage
* @uses : To handle the user control
* @version $id:$
* @since 02-03-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        
        $this->load->helper('url');
        $this->load->helper('pinterest_helper');
		$this->load->library('tank_auth');
        $this->load->model('editprofile_model');
	}
    /**
     * Function handle home and welcome page of a logged user
     * @param   :
     * @author  : Vishal
     * @since   : 01-03-2012
     * @return
     */
	function index()
	{   /*
        $data['title']  = 'Welcome';
        $count = $this->board_model->getAllPins();
        $count =  count($count);
        $this->load->library('pagination');
        $userID =false;
        $order =false;
        $config['base_url'] = site_url().'test/getAllpins';
        $config['uri_segment']          = $this->uri->segment(3,2);
        $offset                         = $this->uri->segment(3,0);
        $data['offset'] = $offset;

        $config['total_rows'] = $count;
        $config['per_page'] = $limit = 30;
        $this->pagination->initialize($config);
        $row = $this->board_model->getAllPinsAjax($offset,$limit);
        $data['row'] = $row;
        //if a valid login
        if(($this->session->userdata('login_user_id')))
        {   
            $fb_data                = $this->session->userdata('fb_data');
            $this->load->model('Facebook_model');
            $data                   = array('fb_data' => $fb_data);//facebook data
            $data['id']            = $this->session->userdata('login_user_id');//logged user id
            $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id
            $data['row'] = $row;
            $this->load->view('welcome', $data);
        }
        //if invalid entry in db , call logout function by passing a paramter to set the invalid login message
        else{
            if($this->session->userdata('noentry_message'))
            {
                $data['invalid']     = $this->session->userdata('noentry_message');
                $this->session->unset_userdata('noentry_message');
            }
            $this->load->view('welcome', $data);
        }*/
        //$count = $this->board_model->getAllPins();
         //$count =  count($count);

         //$this->load->library('pagination');
         $userID =false;
         $order =false;
         //$config['base_url'] = site_url().'test/getAllpins';
         //$config['uri_segment']          = $this->uri->segment(3,2);
         $offset                         = $this->uri->segment(3,0);


        //$config['total_rows'] = $count;
        //$config['per_page'] = $limit = 20;
        $limit = 20;
        $nextOffset = $offset + $limit;
        //$this->pagination->initialize($config);
        $sql = "SELECT *
                    FROM
                        pins";

        if($userID)
            $sql .= " WHERE
                        user_id= $userID ";

        if($order)
        {
            $sql .= " ORDER BY
                        ' $order'";
        }
        else{
            //$sql .= " ORDER BY
                       // RAND()";
            $sql .= " ORDER BY time DESC";
        }
        $sql .= " LIMIT $offset,$limit";

        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->result();

        }
        
        if(!empty($row))
            	$data['row']            = $row;
	    else
		$data['row']            = false;
            
        $data['title']              = 'Welcome';
        //if a valid login
        if(($this->session->userdata('login_user_id')))
        {
            $fb_data                = $this->session->userdata('fb_data');
            $this->load->model('Facebook_model');
            $data                   = array('fb_data' => $fb_data);//facebook data
             $data['id']            = $this->session->userdata('login_user_id');//logged user id
            $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id
            if(!empty($row))
            	$data['row']            = $row;
	    else
		$data['row']            = false;
            $data['offset']         = $nextOffset;
            $this->load->view('welcome', $data);
        }
        //if invalid entry in db , call logout function by passing a paramter to set the invalid login message
        else{
            if($this->session->userdata('noentry_message'))
            {
                $data['invalid']     = $this->session->userdata('noentry_message');
                $this->session->unset_userdata('noentry_message');
            }
             $data['offset'] = $nextOffset;
            $this->load->view('welcome', $data);
        }
    }
    /*
     * Function to load the most liked pins page
     * @param   :
     * @author  : Vishal
     * @since   : 01-03-2012
     * @return
     */
    function mostLiked()
    {   $data['title'] =  'Most liked';
        $this->load->view('mostliked_view', $data);
    }
    /*
     * Function to load the most repined pins page
     * @param   :
     * @author  : Vishal
     * @since   : 01-03-2012
     * @return
     */
    function mostRepinned()
    {   $data['title'] =  'Most Repinned';
        $this->load->view('mostrepin_view', $data);
    }
    /*
     * Function to load the underconstruction page
     * @param   :
     * @author  : Vishal
     * @since   : 01-03-2012
     * @return
     */
    function underconstruction()
    {   $this->sitelogin->entryCheck();
        $data['title'] =  'Under construction';
        $this->load->view('construction_view', $data);
    }
     /*
     * Function not in use
     * @param   :
     * @author  : Vishal
     * @since   : 01-03-2012
     * @return
     */
	function topsecret()
	{
		$fb_data = $this->session->userdata('fb_data');
		if((!$fb_data['uid']) or (!$fb_data['me']))
			redirect('home');
		else
		{
			$data = array(
						'fb_data' => $fb_data,
						);
			$this->load->view('topsecret', $data);
		}
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>