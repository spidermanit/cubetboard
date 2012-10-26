<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
Action controller to handles the actions of a pin. Email, embed , report

* @package pinterest clone controller
* @subpackage
* @uses : To handle all the  actions of a pin. Email, embed , report
* @version $id:$
* @since 03-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Action extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}

    /**
     * Function display email pin popup page
     * @param  : <Int> $boardId,$pinId
     * @author : Vishal
     * @since  : 03-05-2012
     * @return
     */
     public function email($boardId,$pinId)
	 {
         $data['title']      = "Action";
         $data['pinId']      = $pinId;
         $data['boardId']    = $boardId;
         $this->load->view('emailPin_view',$data);
     }

     /**
     * Function display email pin popup page for inner popup pin page
     * @param  : <Int> $boardId,$pinId
     * @author : Vishal
     * @since  : 14-06-2012
     * @return
     */
     public function ajaxEmail()
	 {
         $data['title']      = "Action";
         $data['pinId']      = $this->input->post('pin_id');
         $data['boardId']    = $this->input->post('board_id');
         $value              = $this->load->view('emailPin_view',$data,true);
         echo json_encode($value);
     }

     /**
     * Function display report pin popup page
     * @param  : <Int> $boardId,$pinId
     * @author : Vishal
     * @since  : 03-05-2012
     * @return
     */
     public function report($boardId,$pinId)
	 {
         $data['title']      = "Action";
         $data['pinId']      = $pinId;
         $data['boardId']    = $boardId;
         $this->load->view('reportPin_view',$data);
     }
     /**
     * Function display report pin popup page for inner popup pin page
     * @param  : <Int> $boardId,$pinId
     * @author : Vishal
     * @since  : 03-05-2012
     * @return
     */
     public function ajaxReport()
	 {
         $data['title']      = "Action";
         $data['pinId']      = $this->input->post('pin_id');
         $data['boardId']    = $this->input->post('board_id');
         $value = $this->load->view('reportPin_view',$data,true);
         echo json_encode($value);
     }
     /**
     * Function display embed pin popup page
     * @param  : <Int> $boardId,$pinId
     * @author : Vishal
     * @since  : 03-05-2012
     * @return
     */
     public function embed($boardId,$pinId)
	 {
         $data['title']         = "Action";
         $data['pinId']         = $pinId;
         $data['boardId']       = $boardId;
         $pinDetails            = getPinDetails($pinId);
         $data['pin_url']       = $pinDetails->pin_url;
         $data['source_url']    = $pinDetails->source_url;
         $data['pin_link']      = site_url('board/pins/'.$boardId.'/'.$pinId);
         $data['site_link']     = site_url();
         $userDetails           = userDetails($pinDetails->user_id);
         $data['user']          = $userDetails['name'];
         $data['user_link']     = site_url('user/index/'.$pinDetails->user_id);
         $data['source_name']   = GetDomain($pinDetails->source_url);
         $this->load->view('embedPin_view',$data);
     }
     /**
     * Function display embed pin popup page, for inner popup pin page
     * @param  : <Int> $boardId,$pinId
     * @author : Vishal
     * @since  : 03-05-2012
     * @return
     */
     public function ajaxEmbed()
	 {
         $data['title']         = "Action";
         $data['pinId']         = $pinId = $this->input->post('pin_id');;
         $data['boardId']       = $boardId = $this->input->post('board_id');;
         $pinDetails            = getPinDetails($pinId);
         $data['pin_url']       = $pinDetails->pin_url;
         $data['source_url']    = $pinDetails->source_url;
         $data['pin_link']      = site_url('board/pins/'.$boardId.'/'.$pinId);
         $data['site_link']     = site_url();
         $userDetails           = userDetails($pinDetails->user_id);
         $data['user']          = $userDetails['name'];
         $data['user_link']     = site_url('user/index/'.$pinDetails->user_id);
         $data['source_name']   = GetDomain($pinDetails->source_url);
         $value = $this->load->view('embedPin_view',$data,true);
         echo json_encode($value);
     }
}
/* End of file action.php */
/* Location: ./application/controllers/action.php */