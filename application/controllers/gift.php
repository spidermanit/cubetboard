<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
Gift controller to handles the gift items

* @package pinterest clone controller
* @subpackage
* @uses : To handle  handles the gift items
* @version $id:$
* @since 21-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Gift extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}

    /**
     * Function display gift items with in a price rande
     * @param  : <Int> $id
     * @author : Vishal
     * @since  : 03-05-2012
     * @return
     */
     public function index($from,$to)
	 {
           $data['title']           = "Gift items";
//         $data['id']              = ($id)?$id:$this->session->userdata('login_user_id');//logged user id
//         $data['userDetails']     = $userDetails = userDetails($data['id']);//logged user details from user id
           $data['from']            = $from;
           $data['to']              = $to;
           $count                   = $this->action_model->getGiftItemsCount($from,$to);
           $this->load->library('pagination');
           $config['uri_segment']   = 5;
           $config['base_url']      = site_url('gift/index/'.$from.'/'.$to);
           $config['total_rows']    = 6;
           $config['first_link']    = 'First';
           $config['per_page']      = $limit = 10;
           $offset                  = $this->uri->segment(5,0);
           $this->pagination->initialize($config); 
           $data['result']          = $result = $this->action_model->getGiftItems($from,$to,$offset,$limit);
           $this->load->view('gift_view',$data);
     }
}
/* End of file gift.php */
/* Location: ./application/controllers/gift.php */