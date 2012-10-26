<?php
/**
Facebook model to handles the site functionalities

* @package pinterest clone model
* @subpackage
* @uses : To handles site functionalities
* @version $id:$
* @since 03-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Facebook_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

      
		$config = array(
						'appId'  => $this->config->item('facebook_app_id'),
						'secret' => $this->config->item('facebook_app_secret'),
						'fileUpload' => true, // Indicates if the CURL based @ syntax for file uploads is enabled.
						);
                       
                      
		$this->load->library('Facebook', $config);

		$user = $this->facebook->getUser();

		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		$profile = null;
		if($user)
		{
			try {
			    // Proceed knowing you have a logged in user who's authenticated.
				$profile = $this->facebook->api('/me?fields=id,name,link,email');
			} catch (FacebookApiException $e) {
				error_log($e);
			    $user = null;
			}
		}

		$fb_data = array(
						'me' => $profile,
						'uid' => $user,
						'loginUrl' => $this->facebook->getLoginUrl(array('scope' => 'email,read_stream')),
						'logoutUrl' => $this->facebook->getLogoutUrl(),
					);

		$this->session->set_userdata('fb_data', $fb_data);
	}
    /*
     * Function to check whether a user is already registered or not
     * @param   : $email,$password
     * @author  : Vishal
     * @since   : 01-03-2012
     * @return  : boolean
     */
    function checkLogin($email,$password)
    {
         $sql   = "SELECT
                        username
                    FROM
                        user
                    WHERE
                        email = '$email'
                    AND
                        password = '$password'";
        $query  = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            return true;
        }
    }
    /*
     * Function to check the already exit user
     * @param   : $email,$password
     * @author  : Vishal
     * @since   : 01-03-2012
     * @return  : boolean
     */
    function checkEntry($email)
    {
        $sql = "SELECT 
                    username
                FROM
                    user
                WHERE
                    email = '$email' ";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            return true;
        }
    }
    /*
     * Function to register a user and save to db
     * @param   : $username,$password,$email,$description,$location,$image,$connect_by,$time_created,$time_updated
     * @author  : Vishal
     * @since   : 01-03-2012
     * @return  : boolean
     */
    function register($inset,$facebookId,$twitterID)
    {
//        if($facebookId!=null)
//        {
//            $this->db->where('facebook_id', $facebookId);
//        }
//        if($twitterID!=null){
//                $this->db->where('twitter_id', $twitterID);
//        }
//
//        if(($facebookId!=null) || ($twitterID!=null))
//        {
//            $this->db->update('user', $inset);
//            return true;
//
//        }
//        else{
            $this->db->insert('user', $inset);
            $result = $this->db->insert_id();
        //}
        return $result;
    }
    /**
     * Function to get a particular user profile details from email id
     * @param $email
     * @since 13-03-2012
     * @author vishal 
     * @return <type>
     */
    function getProfileDetails(){
        $sql ="SELECT * from user where email='$email'";
        $query = $this->db->query($sql);
        return $query->result();

    }
    /*
     * Function to get the user from fb id
     * @param  :
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function getUserByFb($fbid)
    {
        $sql = "SELECT
                    id,email
                FROM
                    user
                WHERE
                    facebook_id = $fbid ";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            return $query->row();
        }
    }
    /*
     * Function to insert the first time fb id
     * @param  :
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function insertUser_firstprint($fb_id)
    {
        $sql = "INSERT INTO
                    user(facebook_id)
                VALUEs($fb_id)
                   ";
        $query = $this->db->query($sql);
    }
    /*
     * Function to get user by twitter id
     * @param  :
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function getUserByTwitter($twitter_id)
    {
        $sql = "SELECT
                    id,email
                FROM
                    user
                WHERE
                    twitter_id = $twitter_id ";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            return $query->row();
        }
    }
    /*
     * Function to insert the first time twitter id
     * @param  :
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function insertUser_firstprint_twitter($twitter_id)
    {
        $sql = "INSERT INTO
                    user(twitter_id)
                VALUES($twitter_id)
                   ";
        $query = $this->db->query($sql);
    }
}