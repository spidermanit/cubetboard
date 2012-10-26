<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
Invite controller for user invite and register

* @package pinterest clone controller
* @subpackage
* @uses : To handle the user invite and register
* @version $id:$
* @since 02-03-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Invite extends CI_Controller {

     function __construct()
     {
        parent::__construct();

     }

    /**
     * Function to load the invite user page
     * @param
     * @author  : Vishal
     * @since  : 02-03-2012
     * @return
     */
     public function index()
	 {
         /*Check for an active login*/
         $this->sitelogin->entryCheck();
        /*Hanlde the active fb sessions*/
         $fb_data               = $this->session->userdata('fb_data');
         $data                  = array('fb_data' => $fb_data,);
        /* INVITING USER
         * step 1 : we are going to invite a user. so encode our facebook id as inviting user .
         * step 2 is in invite_view page
        */
        $data['title']         = 'Invite';
        //$data['inviting_user'] = base64_encode($fb_data['me']['id']);
        $data['inviting_user'] = base64_encode($this->session->userdata('login_user_id'));
	$this->load->view('invite_view',$data);
	 }
         public function invitetest()
	 {
         /*Check for an active login*/
         $this->sitelogin->entryCheck();
        /*Hanlde the active fb sessions*/
         $fb_data               = $this->session->userdata('fb_data');
         $data                  = array('fb_data' => $fb_data,);
        /* INVITING USER
         * step 1 : we are going to invite a user. so encode our facebook id as inviting user .
         * step 2 is in invite_view page
        */
        $data['title']         = 'Invite';
        //$data['inviting_user'] = base64_encode($fb_data['me']['id']);
        $data['inviting_user'] = base64_encode($this->session->userdata('login_user_id'));
	$this->load->view('invite_view_test',$data);
	 }
     /**
     * Function send invite email to the all invited friends
     * @param
     * @author : Vishal
     * @since  : 02-03-2012
     * @return
     */
    function submit()
    {
        $this->load->library('email');
        $config['mailtype']             = 'html';
        $config['wordwrap']             = true;
        $this->email->initialize($config);
        $this->email->from('info@pinterestclone', 'Pinterest');
        unset($_POST['submit']);

        $message                        = $_POST['message'];
        unset($_POST['message']);
        $userdetails = userDetails();
        foreach ($_POST as $value) {
            $text = 'Hi,';
            $text .='<br/>';
            $text .='You have been invited to join cubet board By '.$userdetails['name'];
            $text .='<br/>';
            $text .='Please click the following link to join '.site_url('/invite/entry/'.base64_encode($value));
            $text .='<br/>';
            $text .='Thanks';
            $text .= '<br/>';
            $text .='CubetBoard';
            $this->email->to($value);
            $this->email->subject('You are invitted');
            $this->email->message($text);
            $this->email->send();
        }
        echo json_encode(true);
    }
    /**
     * Function check the entry page for register of invited users
     * @param   : $mail
     * @author  : Vishal
     * @since   : 02-03-2012
     * @return
     */
    function entry($mail=false)
    {

        $this->load->model('facebook_model');

        /*Check for registration of already exist email.?*/
        if($this->session->userdata('check_entry'))
        {
            $data['check_entry']            = true;
            $this->session->unset_userdata('check_entry');
        }

        /*Collect the email if from url, to which the request  to send*/
        $data['email']                      = $email = base64_decode($mail);

        /*Collect twitter login details. If twitter login details, then we need to check for twitter entry match in db*/
        $data['twitter_username']           =  $this->session->userdata('twitter_username');
        $data['twitter_userid']             =  $this->session->userdata('twitter_userid');

        /*Collect fb login details. If fb login details, then we need to check for fb entry match in db*/
        $fb_data                            = $this->session->userdata('fb_data');

        /*Step5 of inviting user
         * step 4 is in fb_login view page
         * Facebook invite entry for new.. message request.
         * if a user is invited then and he clicked the invited link , then the invition send user fb will send
         * allow the new invited user to login. so reirect to login page. Next step 6 in login contoller
         */
        


        $data['emailList']                  = $emailList = $this->admin_model->getUsersEmail();
        /*Facebook entry check  */

        /* Step 8 of inviting user. Previous step in login controller*/
        if((($fb_data['uid']) && ($fb_data['me']) &&  ($fb_data['uid']!=0)&&($fb_data['uid']!='') && (!$mail)))
        {
            /*Collect the details of logged fb id from table*/
            $fbIdCheck                      = $this->facebook_model->getUserByFb($fb_data['uid']);

            

            /*if no such id present, we are logged in for the first time, so insert that id to db*/
            if(empty ($fbIdCheck))
            {
                if($this->config->item('need_invite')==1)
                {
                    if($this->session->userdata('compulsory_invite'))
                    {
                        //$insertData               = $this->facebook_model->insertUser_firstprint($fb_data['uid']);
                        $data['normal_entry']       = 0;
                        $data['orginal_email']      = $fb_data['me']['email'];
                        $data['check_entry']        = false;
                        $data['login_with']         = 'facebook';
                        $this->load->view('register',$data);
                    }
                    else{
                        $message    =  'You must need a facebook request to join ';
                        redirect('auth/logout/noentry/'.$message);
                        break;
                    }
                }
                else{
                    //$insertData               = $this->facebook_model->insertUser_firstprint($fb_data['uid']);
                    $data['normal_entry']       = 0;
                    $data['orginal_email']      = $fb_data['me']['email'];
                    $data['check_entry']        = false;
                    $data['login_with']         = 'facebook';
                    $this->load->view('register',$data);
                }



            }

            /*Again collect the details of logged fb id from table*/
            //$fbIdCheck                      = $this->facebook_model->getUserByFb($fb_data['uid']);

            /*If corresponding email id is missing, then redirect the user to register form to enter the user details*/
            //if($fbIdCheck->email== "")
            //{

            //}


            /*If facebook id and email present in db , then registration is success, redirect to user page after login sessiosn set*/
            else
            {               
                $this->sitelogin->loginCheck();//set loggin sessions in sitelogin library
                if((!$this->session->userdata('login_user_id')))
                {   
                    $message    =  $this->session->userdata('noentry_message');
                    redirect('auth/logout/noentry/'.$message);
                    break;
                }
                else{
                      redirect($this->session->userdata('redirect_url'));
                }
               
            }
        }


        /*Twitter entry check*/
        elseif($this->session->userdata('twitter_userid'))
        {
            /*Collect session data retrieved from twitter after login*/
            $twitter_id                 = $this->session->userdata('twitter_userid');

            /*Collect the details of logged twitter id from table*/
            $twitter                    = $this->facebook_model->getUserByTwitter($twitter_id);

            /*If no such id present, we are logged in for the first time, so insert that id to db*/
            if(empty($twitter))
            {
                //$insertData             = $this->facebook_model->insertUser_firstprint_twitter($twitter_id);
                $twitterDetails               = $this->session->userdata('twitter_details');
                
                $data['normal_entry']         = 0;
                $data['orginal_email']        = 'no email';
                $data['check_entry']          = false;
                $data['login_with']           = 'twitter';
                $this->load->view('register',$data);
            }

            /*Again collect the details of logged twitter id from table*/
           // $twitter                    = $this->facebook_model->getUserByTwitter($twitter_id);

            /*If corresponding email id is missing, then redirect the user to register form to enter the user details*/
//            if($twitter->email == "")
//            {
//                $data['check_entry']    = false;
//                $this->load->view('register',$data);
//            }


            /*If twitter id and email present in db , then registration is success, redirect to user page after login sessiosn set*/
            else
            {
                $this->sitelogin->loginCheck();//set loggin sessions in sitelogin library
                if((!$this->session->userdata('login_user_id')))
                {   $message    =  $this->session->userdata('noentry_message');
                    redirect('auth/logout/noentry/'.$message);
                    break;
                }
                else{
                     redirect($this->session->userdata('redirect_url'));
                }
            }
        }

        /*Normal user invite from email id*/
        else{
            /*we are handling a normal user invite and entry */
            if($mail)
            {   /*Check for the email alreay exist, if yes set check_entry and load already exist message in register page(hiding registeration form) */
                
                $this->sitelogin->loginCheck();
                if(($this->session->userdata('login_user_id')))
                {   
                    $data['normal_entry']    = '';
                    $data['login_with']      = 'email';
                    $data['orginal_email']   = '';
                    $message =  "Another login session found .Please logout and then click the link";
                    $data['message'] = $message;
                }
                else{
                    $data['check_entry']     = $this->facebook_model->checkEntry($email);
                    $data['normal_entry']    = 1;
                    $data['orginal_email']   = $mail;
                    $data['login_with']      = 'email';
                }
                $this->load->view('register',$data);
            }
            else{
                /*If no invite mail , redirect to user page after setting the sessions.*/
                $data['check_entry']     = false;
                $data['normal_entry']    = 1;
                $data['orginal_email']   = '';
                $data['login_with']      = 'email';
                $this->load->view('register',$data);
            }
        }
    }
    /**
     * Function save the registered details to db and to upload the image
     * @param  :
     * @author : Vishal
     * @since  : 06-03-2012
     * @return
     */
    function register()
    {   
        
        if(!empty($_POST))
        {
            $insert = array();//array to hold the registered user details
            $normal = 1;//flag to denote normal user login.
            $insert['username']      = $username       = $this->input->post('username');
            $insert['password']      = $password       = md5($this->input->post('pass1'));
            $insert['email']         = $email          = $this->input->post('email');
            $insert['description']   = $description    = $this->input->post('description');
            $insert['location']      = $location       = $this->input->post('location');
            $image                   = '';
            $insert['connect_by']    = $connect_by     = 'normal';
            $insert['time_created']  = $time_created   = time();
            $insert['time_updated']  = $time_updated   = time();

            $this->load->model('facebook_model');

            /*Check whether the invited email is already exist in db, if yes redirect to entry page display the message for login instead of register*/
            $data['check_entry']        = $emailCheck = $this->facebook_model->checkEntry($email);
            if($emailCheck)
            {   $this->session->set_userdata('check_entry',true);
                redirect('/invite/entry');
            }

            else
            {

              /*If user is registering using facebook*/
              $fb_data                          = $this->session->userdata('fb_data');
              if((($fb_data['uid']) && ($fb_data['me']) &&  ($fb_data['uid']!=0) && ($fb_data['uid']!='')) )
              {
                  $facebookId                   = $fb_data['uid'];
                  if(($image==''))
                  {
                      $image                    = "https://graph.facebook.com/{$facebookId}/picture";
                  }
                  $name                         = $fb_data['me']['name'];
                  list($firstname,$lastname)    = explode(' ',"$name");
                  $insert['facebook_id']        = $facebookId;
                  $insert['first_name']         = $firstname;
                  $insert['last_name']          = $lastname;
                  $insert['connect_by']         = $connect_by = 'facebook';
                  $insert['image']              = $image;
                  $insert['verification']       = 'done';
                  $insert['status']             = 1;
                  $normal                       = 0;

              }
              else
                  $facebookId = null;

              /*If user is registering using twitter*/
              if($this->session->userdata('twitter_id'))
              {
                  $twitterID = $this->session->userdata('twitter_id');
                  $twitterDetails               = $this->session->userdata('twitter_details');

                  if(empty ($twitterDetails))
                  {    $data['cookie_messsage'] =1;
                       $this->load->view('verification_view',$data);
                       break;
                  }

                  if(($image==''))
                  {
                      $image                    = $twitterDetails['profile_image_url'];
                  }
                  $name = $twitterDetails['name'];
                  $insert['twitter_id']         = $twitterID;
                  list($firstname,$lastname)    = explode(' ',"$name");
                  $insert['first_name']         = $firstname;
                  $insert['last_name']          = $lastname?$lastname:'';
                  $insert['connect_by']         = $connect_by = 'twitter';
                  $insert['image']              = $image;
                  $insert['verification']       = rand(5, 15);
                  $insert['status']             = 0;
                  $normal                       = 0;

              }
              else
                  $twitterID = null;

              /*If user is registering as normal user..from email invite*/
              if($normal == 1)
              {
                      /*Hanlde the user image sumitted. Upload to /application/assets folder in the encode name of email*/
                    if($_FILES["file"]["name"]!='')
                    {    $ext            = explode('/', $_FILES["file"]["type"]);
                         $image          = ($_FILES)?(base64_encode($email).'.'.$ext[1]):'';

                        if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/png")|| ($_FILES["file"]["type"] == "image/jpg")|| ($_FILES["file"]["type"] == "image/PNG")|| ($_FILES["file"]["type"] == "image/GIF")|| ($_FILES["file"]["type"] == "image/JPG")|| ($_FILES["file"]["type"] == "image/JPEG")))
                        {
                            if ($_FILES["file"]["error"] > 0)
                            {
                                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                            }
                            else
                            {

                                if (file_exists(getcwd()."/application/assets/images/" . $image))
                                {   unlink(getcwd()."/application/assets/images/" . $image);
                                    move_uploaded_file($_FILES["img"]["tmp_name"],
                                    getcwd()."/application/assets/images/" . $image);
                                    $image = site_url('application/assets/images/'.$image);
                                }
                                else
                                {
                                    move_uploaded_file($_FILES["file"]["tmp_name"],
                                    getcwd()."/application/assets/images/" . $image);
                                    $image = site_url('application/assets/images/'.$image);
                               }
                               
                            }
                          }
                          else
                          {
                            $image                = site_url('application/assets/images/User.png');
                          }
                    }

                  $this->session->set_userdata('normal_login',1);
                  if(($image==''))
                  {
                      $image                = site_url('application/assets/images/User.png');
                  }
                  $insert['first_name']     = $this->input->post('firstname');
                  $insert['last_name']      = $this->input->post('lastname');
                  $insert['connect_by']     = $connect_by = 'normal';
                  $insert['image']          = $image;
                  $insert['verification']   = rand(5, 15);
                  $insert['status']         = 0;

                  /*set normal loggin sessions. This session is check in sitelogin library for setting normal user login sessions*/
                  $this->session->set_userdata('normal_login',1);
                  $this->session->set_userdata('normal_user_email',$email);

              }


              $register = $this->facebook_model->register($insert,$facebookId,$twitterID);//Insert db

              $this->session->unset_userdata('invited_user');
              $this->session->unset_userdata('compulsory_invite');

              if($connect_by=='facebook')
              {   $this->sitelogin->loginCheck();//set login sessions
                  $this->_createDefaultBoard($register);//create a default board for the user
                  $this->_emailAlert($insert);//send an email to the registered user.
                  redirect();//redirect to user page

              }
              else{
                  $this->_createDefaultBoard($register);//create a default board for the user
                  $this->_emailAlert($insert,$this->input->post('pass1'));//send an email to the registered user.
                  $this->load->view('verification_view',$insert);
              }

            }
            unset($_POST);
        }
        else{
            redirect('login/handleLogin');
        }
    }
    /**
     * Function to send a registration sucess email to the user
     * @param <array> $insert
     * @param <string> $pass
     * @since 27-04-2012
     * @author Vishal Vijayan
     */
    function _emailAlert($insert,$pass=false)
    {
        $this->load->library('email');
        $config['mailtype']     = 'html';
        $config['wordwrap']     = true;
        $this->email->initialize($config);
        $this->email->from('info@pinterestclone', 'Pinterest');

        $message                        = "Dear ".$insert['first_name'].' '.$insert['last_name'].'<br/>';
        $message                        .= "Thankyou for registering with us.".'<br/>';
        $message                        .= "You are connected as ".$insert['connect_by'].' user'.'<br/>';
        switch ($insert['connect_by'])
        {
            case 'facebook':
                $message               .= "You can login using your facebook login details".'<br/>';
                $msg                    = 'Please click the following link to start pinning '.site_url();
                $message                = $message.'</br>'.$msg;
                break;
            case 'twitter':
                $message               .= "Please verify your email by clicking the link ".'<br/>';
                $msg                    = site_url().'verification/index/'.base64_encode($insert['email']).'/'.base64_encode($insert['verification']);
                $message                = $message.'</br>'.$msg;
                break;
            case 'normal':

                $message               .= "Your username: ".$insert['email'].'<br/>';
                $message               .= "Your password: ".$pass.'<br/>';
                $message               .= "Please verify your email by clicking the link ".'<br/>';
                $msg                    = site_url().'verification/index/'.base64_encode($insert['email']).'/'.base64_encode($insert['verification']);
                $message                = $message.'</br>'.$msg;
                break;
        }


        $this->email->to($insert['email']);
        $this->email->subject('Thankyou for registering with us');
        $this->email->message($message);
        $this->email->send();

    }
    /**
     * Function to create a default board for the user.
     * @param
     * @since 27-04-2012
     * @author Vishal Vijayan
     */
    function _createDefaultBoard($userId)
    {
       $boardArray =  array
                        (
                        'user_id'       => $userId,
                        'board_name'    => 'My collections',
                        'who_can_tag'   => 'me',
                        'board_title'   => 'My collections',
                        'category'      => 'collection',
                        'collaborator'  => 'Name or Email Address'
                        );
       $this->board_model->createBoard($boardArray);
    }
    /**
     * test function not in use
     */
    function test()
    {   error_reporting(0);
        $data['email'] = 'vishal@cubettech.com';
        $this->load->view('register',$data);
    }
}

/* End of file invite.php */
/* Location: ./application/controllers/invite.php */