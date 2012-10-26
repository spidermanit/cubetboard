<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
  Login controller for user login
* @package pinterest clone controller
* @subpackage
* @uses : To handle the user login . Normal login
* @version $id:$
* @since 02-03-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Login extends CI_Controller {

    /**
     * Function load the login page
     * @param   : $mail
     * @author  : Vishal
     * @since   : 01-03-2012
     * @return
     */
     function index($current=false,$r_segment=false)
     {
        
         /*If any active login redirect home*/
         
         /*Load twitter session if any*/
         $data['twitter_username'] =  $this->session->userdata('username');
         $this->session->unset_userdata('twitter_userid');
         $this->session->unset_userdata('twitter_userid');
         $this->tweet->logout();


         /*If we login using facebook, then we will retrun back here after login. In such case fb session will set*/
         /*Load fb session [fb session will set, if we logged in using fb details,]*/
         $this->load->model('Facebook_model');
         $fb_data       = $this->session->userdata('fb_data');
         $data          = array('fb_data' => $fb_data,);
         
         /*If fb session is set*/
         if((($fb_data['uid']) && ($fb_data['me']) &&  ($fb_data['uid']!=0)&&($fb_data['uid']!='')))
         {
            
            /*
            Step 7 of inviting user
            Since the invition send user id is active, the new logged in user represents a fresh user.
            so allow him to register (in step 8 in invite controller entry function)
            before that unset the invition send user id
             */
            
            

            /*
            Load fb session [fb session will set, if we logged in using fb details, then we must need to check for
            corresponding id in db. These check are done in loginCheck function of sitelogin library*/
            //$this->sitelogin->loginCheck();
             if($this->config->item('need_invite')==1)
             {
                    if($this->session->userdata('invited_user'))
                    {   $this->session->unset_userdata('invited_user');
                        redirect('/invite/entry');
                    }
                    else{
                        $this->session->set_userdata('noentry',1);
                        $this->session->set_userdata('noentry_message',"You must need a facebook invite to join");
                        redirect();
                    }
             }
             else{
                redirect('/invite/entry');
             }
             

         }
         /*If no fb session is set*/
         else{
              
                /*Load login page*/
                /*
                step 6 of inviting user,previous step in invite controller entry function. since a valid fb session of the new user is not set, it will load the login page
                after fb login, redirect back in same function . At that tme fb sessions are set. so above loop will work
                Step 7 is in above loop
                */
                $this->load->view('login',$data);
         }

    }
    /**
     * Function pre handle the login function 
     * @param   : $mail
     * @author  : Vishal
     * @since   : 01-03-2012
     * @return
     */
    function handleLogin()
    {
        /*Set redirect url from popup page*/
        if($_GET)
        {
            $next =  $_GET['next'];
            $redirect = site_url().$next;
            $this->session->set_userdata('redirect_url',$redirect);
          
        }
        $this->load->model('Facebook_model');
        $fb_data       = $this->session->userdata('fb_data');
        
        $this->tweet->logout();
        if((($fb_data['uid']) && ($fb_data['me']) &&  ($fb_data['uid']!=0)&&($fb_data['uid']!='')))
        {
            redirect($fb_data['logoutUrl']);
        }
        else{
            redirect('login/index');
        }
        
    }
    /**
     * Function handle the normal user login
     * @param   :
     * @author  : Vishal
     * @since   : 01-03-2012
     * @return
     */
    function normal()
    {
         $this->load->model('facebook_model');
         $email     = $this->input->post('email');
         $password  = md5($this->input->post('password'));
         $login     = $this->facebook_model->checkLogin($email,$password);

         if($login)
         {
             $this->session->set_userdata('normal_login',1);
             $this->session->set_userdata('normal_user_email',$email);
         }
         $this->sitelogin->loginCheck();

         if(!$this->session->userdata('login_user_id'))
         {
            $message =  $this->session->userdata('noentry_message');
            redirect('auth/logout/noentry/'.$message);
            break;
         }
         else{
             redirect($this->session->userdata('redirect_url'));
         }  
    }
    /*
     * test function
     */
    function insertInvitedId()
    {
        $id =$this->input->post('ids');
        if(stristr("Hello world!","WORLD"))
        $idArray = explode(',', $id);
        else{
            $idArray[0] = $id;
        }
        $return = $this->login_model->insertInvitedId($idArray);
        echo json_encode($return);
    }
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */