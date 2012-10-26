<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
  Site entry library to check user login
* @package pinterest clone library
* @subpackage
* @uses : To handle the user login check
* @version $id:$
* @since 10-04-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class sitelogin
{
    /**
     * Constructor function
     * @param
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function sitelogin()
    {
        $this->CI = &get_instance();
    }
    /**
     * Function to check a valid user login
     * @param
     * @author : Vishal
     * @since  : 10-04-2012
     * @return
     */
    function entryCheck()
    {   
        
        $r_segments = func_get_args(); //get current arguments of the url
        if (is_array($r_segments)) {
            $r_segments = '/' . implode('/', $r_segments);// impolde it
        }
        $current =  current_url();// current url
        
        if(!$this->CI->session->userdata('login_user_id'))
        {   //set the request url in session before login and redirect to that
            //requested url after login from login controller (for facebook), invite controller (for normal and twitter login)
            if($this->CI->session->userdata('redirect_url'))
            {
                
            }
            else{

                $this->CI->session->set_userdata('redirect_url',$current.$r_segments);
            }
            redirect('/login/handleLogin');

        }
    }
    /*Function not in use*/
    function entryAdminCheck()
    {   
        
        $r_segments = func_get_args(); //get current arguments of the url
        if (is_array($r_segments)) {
            $r_segments = '/' . implode('/', $r_segments);// impolde it
        }
        $current =  current_url();// current url
        
        if(!$this->CI->session->userdata('admin_login'))
        {   //set the request url in session before login and redirect to that
            //requested url after login from login controller (for facebook), invite controller (for normal and twitter login)
            if($this->CI->session->userdata('redirect_url'))
            {
                
            }
            else{
                $this->CI->session->set_userdata('redirect_url',$current.$r_segments);
            }
            redirect('/administrator/login');
        }
    }
    /**
     * Function to check a valid user login by checking the entry in database and set the user id session if present
     * @param
     * @author : Vishal
     * @since  : 10-04-2012
     * @return
     */
    function loginCheck()
    {
        //Fb login check 
        $fb_data                = $this->CI->session->userdata('fb_data');
        $noentryMessage         = "Invalid login";
        if((($fb_data['uid']) && ($fb_data['me']) &&  ($fb_data['uid']!=0)&&($fb_data['uid']!='')))
        {
             $referenceId       = $fb_data['uid'];
             $reference         = 'facebook_id';
             $this->CI->session->set_userdata('referenceId',$referenceId);
             $this->CI->session->set_userdata('reference',$reference);
             $login             = $this->CI->login_model->getProfileDetails($referenceId,$reference);
             //$noentryMessage    = "Your facebook doesnt have a pininterest account.Invalid login";
        }
        //Twitter login check
        elseif($this->CI->session->userdata('twitter_userid'))
        {           
             $referenceId       = $this->CI->session->userdata('twitter_userid');
             $reference         = 'twitter_id';
             $this->CI->session->set_userdata('referenceId',$referenceId);
             $this->CI->session->set_userdata('reference',$reference);
             $login             = $this->CI->login_model->getProfileDetails($referenceId,$reference);
             //$noentryMessage    = "Your twitter doesnt have a pininterest account.Invalid login";
        }
        //Normal login check
        elseif($this->CI->session->userdata('normal_user_email'))
        {
            $referenceId        = $this->CI->session->userdata('normal_user_email');
            $reference          = 'email';
            $this->CI->session->set_userdata('referenceId',$referenceId);
            $this->CI->session->set_userdata('reference',$reference);
            $login              = $this->CI->login_model->getProfileDetails($referenceId,$reference);
            //$noentryMessage     = "Invalid login";
        }
        else{
            $noentryMessage     = "Invalid login";
        }
        //Check for logged entry in db
        if(isset($login))
        {   if($login->verification!='done')
            {
                $noentryMessage    = "Your account is not verified.Invalid login";
                $this->CI->session->set_userdata('noentry',1);
                $this->CI->session->set_userdata('noentry_message',$noentryMessage);
            }
            elseif($login->status!=1)
            {
                $noentryMessage    = "Your account has been blocked.Invalid login";
                $this->CI->session->set_userdata('noentry',1);
                $this->CI->session->set_userdata('noentry_message',$noentryMessage);
            }
            else{
                //get current user id
                $neededValue        = 'id';
                $data['userid']     = getUserDetails($referenceId,$reference,$neededValue);
                $this->CI->session->set_userdata('login_user_id', $data['userid']);
            }
        }
        else{
            $this->CI->session->set_userdata('noentry',1);
            $this->CI->session->set_userdata('noentry_message',$noentryMessage);
        }
    }
    /**
     * Function to handle the user details either logged in user or other users
     * @since 12-04-2012
     * @author Vishal Vijayan
     * @param
     * @return <type> array
     */
    function userDetails($id=false)
    {
        if($id)
            $id     = $id;
        else
            $id     = $this->CI->session->userdata('login_user_id');
        $login      = $this->CI->login_model->getProfileDetails($id,'id');

        $userDetails = array();
        //logged user details
        if(!empty ($login))
        {
            $userDetails = array('userId' => $id,
                                'name'   => $login->first_name.' '.$login->last_name,
                                'email'  => $login->email,
                                'image'  => $login->image,
                                'description'  => $login->description
                            );
        }
        return $userDetails;
    }
    /**
     * Function to get the profile image of a user. This function is currently not in use
     * @since 12-04-2012
     * @author Vishal Vijayan
     * @param
     * @return <type> url
     */
    function _getProfileImage($reference,$referenceID=false)
    {
        if($reference=='facebook')
        {
            $imageUrl           = "https://graph.facebook.com/".$referenceID."/picture";
        }
        elseif($reference=='twitter')
        {   $twitterDetails     = $this->CI->session->userdata('twitter_details');
            $imageUrl           = $twitterDetails['profile_image_url'];
        }
        elseif($reference=='normal')
        {
            $filename           = getcwd().'/application/assets/images/'.base64_encode($referenceID).'.jpeg';
            if (file_exists($filename))
                $imageFile      = getcwd().'/application/assets/images/'.base64_encode($referenceID).'.jpeg';
            else
               $imageFile       = getcwd().'/application/assets/images/'.'User.png';
        }

        return $imageUrl;
    }
    /**
     * Function to logout. Function currently not in use. We are using the logout function in auth controller
     * @since 12-04-2012
     * @author Vishal Vijayan
     * @param
     * @return 
     */
    function _logout($noentry=false)
	{

        $fb_data = $this->CI->session->userdata('fb_data');
		$data = array('fb_data' => $fb_data,);
		$this->CI->tank_auth->logout();
        $this->CI->tank_auth->is_logged_in(false);
		$this->CI->session->set_userdata(array('twitter_id' => '', 'facebook_id' => ''));
        $this->CI->session->unset_userdata('twitter_id');
        $this->CI->session->unset_userdata('status');
        $this->CI->session->unset_userdata('username');
        $this->CI->session->unset_userdata('user_id');
        $this->CI->session->unset_userdata('normal_login');
        $this->CI->session->unset_userdata('normal_user_email');
        $this->CI->session->unset_userdata('login_true');
        $this->CI->session->unset_userdata('login_user_id');
        $this->CI->session->sess_destroy();
        //check for message setting for  a invalid login entry
        if($noentry)
        $this->CI->session->set_userdata('noentry',true);
        redirect($data['fb_data']['logoutUrl']);
		//$this->_show_message($this->lang->line('auth_message_logged_out'));
	}
}
?>