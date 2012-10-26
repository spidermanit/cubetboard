<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
  Password controller to change and reset password
* @package pinterest clone controller
* @subpackage
* @uses : To handle to reset and change user password
* @version $id:$
* @since 02-03-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Password extends CI_Controller {

     function __construct()
	 {
		parent::__construct();
        //$this->sitelogin->entryCheck();
	 }

    /**
     * Function to change user password
     * @param
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
     public function index()
	 {
         $this->sitelogin->entryCheck();
        $this->load->helper('pinterest_helper');
        $data['title']                      = 'Change password';
        $data['message']                    = $message='';
        $data['olderror']                   = $olderror='';

        /*get reference id and reference field*/
        $referenceId                        = $this->session->userdata('referenceId');
        $reference                          = $this->session->userdata('reference');
        //get current password
        $neededValue                        = 'password';
        if($referenceId)
            $data['password']               = $password = (getUserDetails($referenceId,$reference,$neededValue));
        else
            redirect();
        //if new passwords submit
        if($_POST)
        {            
            $old                            = $this->input->post('old_password');
            $new1                           = $this->input->post('new_password1');
            $new2                           = $this->input->post('new_password2');
            //check for the old passwords matching
            if(md5($old)!=$password)
                $data['olderror']           =  $olderror .='seems to be a wrong value';
            else{
                //if correct update the db table
                $this->load->model('editprofile_model');
                $this->editprofile_model->changePassword(md5($new1),md5($old),$reference,$referenceId);
                $data['message']            = 'saved successfully';
            }
        }
        //$this->load->view('header',$data);
		$this->load->view('changepassword_view',$data);
	 }
     /**
     * Function to reset user password
     * @param
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
     function reset()
     {   //$this->sitelogin->entryCheck();
         $data['title']             = 'Reset password';
         if($_POST)
         {
            $email                  = $this->input->post('email');//mail id to where the reset email to send
            $this->load->library('email');
            $config['mailtype']     = 'html';
            $config['wordwrap']     = true;
            $this->email->initialize($config);
            $this->email->from('info@pinterestclone', 'Pinterest');
            $timestamp = base64_encode(time());//encode current time stamp
            $msg                    = 'please click the following link to reset your password '.site_url('/password/newpass/'.base64_encode($email).'/'.$timestamp);
            $this->email->to($email);
            $this->email->subject('Reset your password');
            $this->email->message($msg);
            $this->email->send();
            $data['message']        = "Password reset link is sent to your email. please check it";
          }
          if(isset($_POST['type']))
          {
              echo json_encode(true);
          }
          else{
              $this->load->view('header',$data);
              $this->load->view('reset',$data);
          }  
     }
     /**
     * Function to enter and save the new passwords in password reset
     * @param  : $email
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
     function newpass($email=false,$timestamp=false)
     {  $this->load->model('facebook_model');
        $data['success']        = 0;
        //if new passwords submit...[ Note that the else part will work first ]
        if($_POST)
        {
            $newpass            = $this->input->post('new_password1');//new password
            $email              = $this->input->post('email');//email is

            $this->load->model('editprofile_model');
            $this->editprofile_model->resetPassword(md5($newpass),$reference='email',$email);//update password
            $data['success']    = 1;
            //$this->_resetLogout();//unset sessions
            //$noentryMessage = "Your password has been reset successfuly!. You have to login again";
            //$noentryMessage = $this->session->set_userdata('noentry_message',$noentryMessage);
            //redirect('auth/logout/'.$noentryMessage);
            //$data['success'] = 1;
        }
        else{
            ////if email and time stamp in reset link
            if($email&&$timestamp)
            {   //check  whether the reset link expire !! ... validity of 24 hours from the time of email send.
                if( (strtotime("+24 hours", base64_decode($timestamp))<time() ) )
                {   
                    $data['emailcheck'] = 0;
                }
                else{
                    $data['email']          = (base64_decode($email));
                    $data['check_entry']    = $emailCheck = $this->facebook_model->checkEntry((base64_decode($email)));
                    //check for that email is a valid email in db
                    if($emailCheck)
                       $data['emailcheck']  = 1;
                    else
                        $data['emailcheck'] = 0;
                }

            }
            else{
                redirect();
            }
        }

       // if($emailCheck)
        //{
          $this->load->view('newpass',$data);
       // }
       // else{
        //    $noentryMessage = "your email id is invalid or password reset time expired";
        //    $noentryMessage = $this->session->set_userdata('noentry_message',$noentryMessage);
          //  redirect('auth/logout/'.$noentryMessage);
        //}
     }
     /**
     * Function to logout the sessions after reset
     * @param   : 
     * @author  : Vishal
     * @since   : 20-03-2012
     * @return
     */
     function _resetLogout()
     {  //reset all sessions if password change.
        $this->session->unset_userdata('fb_data');
        $this->session->set_userdata(array('twitter_id' => '', 'facebook_id' => ''));
        $this->session->unset_userdata('twitter_id');
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('normal_login');
        $this->session->unset_userdata('normal_user_email');
        $this->session->unset_userdata('login_user_id');
        $this->session->sess_destroy();
     }
     /*
      * Test function
      */
     function test()
     {

        $to = "vishal@cubettech.com";
        $subject = "Hi!";
        $body = "Hi,\n\nHow are you?";
        if (mail($to, $subject, $body)) {
           echo("<p>Message successfully sent!</p>");
        } else {
        echo("<p>Message delivery failed...</p>");
        }

     }
}

/* End of file password.php */
/* Location: ./application/controllers/password.php */