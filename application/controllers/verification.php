<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
Verification controller to handles the email Verification part

* @package pinterest clone controller
* @subpackage
* @uses : To handle all the  actions of a pin. Email, embed , report
* @version $id:$
* @since 03-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Verification extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        //$this->sitelogin->entryCheck();
	}

    /**
     * Function Verification of email
     * @param  : <Int> $email,$code
     * @author : Vishal
     * @since  : 03-05-2012
     * @return
     */
     public function index($email,$code)
	 {
         if($email&&$code)
         {
            $data['title']      = "Email verfication";
            $data['email']      = $email = base64_decode($email);
            $data['code']       = $code = base64_decode($code);;
            $success            = $this->login_model->verify($email,$code);
            if($success)
            {   $data['success'] = $success;
                $this->sitelogin->loginCheck();//set login sessions
                
            }
            else{
                $data['failed'] = true;
            }
            $this->load->view('verification_view',$data);
         }
         else{
             redirect();
         }
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
}
/* End of file verification.php */
/* Location: ./application/controllers/verification.php */