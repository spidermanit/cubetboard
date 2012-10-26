<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 Edit profile controller for user profile edit

* @package pinterest clone controller
* @subpackage
* @uses : To handle the user profile edit
* @version $id:$
* @since 02-03-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Editprofile extends CI_Controller {

    function __construct()
	{
        parent::__construct();
        $this->sitelogin->entryCheck();
	}

    /**
     * Function to show edit user profile page
     * @param
     * @author : Vishal
     * @since  : 13-03-2012
     * @return
     */
     public function index()
	 {
            $referenceId        = $this->session->userdata('referenceId');
            $reference          = $this->session->userdata('reference');

            if(!isset($referenceId)&&(!isset($reference)))
            redirect();

            $data['title']      = 'Edit profile';
            $this->load->model('editprofile_model');
            $data['result']     = $this->editprofile_model->getProfileDetails($referenceId,$reference);
            $data['emailList']                  = $emailList = $this->admin_model->getUsersEmail();
            $this->load->view('header', $data);
            $this->load->view('editprofile_view',$data);
	 }
     
     /**
     * Function to save the editted profile
     * @param
     * @author : Vishal
     * @since  : 13-03-2012
     * @return
     */
     function save()
     {
         unset($_POST['csrfmiddlewaretoken']);
         unset($_POST['submit']);
         
         $imagename = '';
         //if we are uploading a new image
         if(($_FILES)&&($_FILES['img']['name']!=''))
         {   
             $ext            = explode('/', $_FILES["img"]["type"]);//get the file extension from file type

             //create the new upload image as the base64 encode value of email with image extension.
             $image          = ($_FILES)?(base64_encode($_POST['email']).'.'.$ext[1]):'';

            //check for a valid image/image size and type
            if ((($_FILES["img"]["type"] == "image/gif")|| ($_FILES["img"]["type"] == "image/jpeg")|| ($_FILES["img"]["type"] == "image/png")|| ($_FILES["img"]["type"] == "image/jpg")|| ($_FILES["img"]["type"] == "image/PNG")|| ($_FILES["img"]["type"] == "image/GIF")|| ($_FILES["img"]["type"] == "image/JPG")|| ($_FILES["img"]["type"] == "image/JPEG")))
            {
                if ($_FILES["img"]["error"] > 0)
                {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                }
                else
                {   // if a valid image
                    $imagename =  $image;
                    //check for a image exist in that name , if yes unlink the image and upload the new
                    if (file_exists(getcwd()."/application/assets/images/" . $image))
                    {
                       unlink(getcwd()."/application/assets/images/" . $image);
                       move_uploaded_file($_FILES["img"]["tmp_name"],
                        getcwd()."/application/assets/images/" . $image);
                    }
                    else
                    {   //if no such image name, then upload the new image
                        move_uploaded_file($_FILES["img"]["tmp_name"],
                        getcwd()."/application/assets/images/" . $image);
                   }
                }
              }
              else
              {
               $imagename                = 'User.png';
              }
              //assign it to the post array for updating the image
              $imagename = site_url('application/assets/images/'.$imagename);
              $_POST['image'] = $imagename?$imagename:'';
         }

        $referenceId    = $this->session->userdata('referenceId');
        $reference      = $this->session->userdata('reference');

        $this->load->model('editprofile_model');

        if(isset($_POST['facebook_post']))
            $_POST['facebook_post']     = 1;
        else
             $_POST['facebook_post']    = 0;

        if(isset($_POST['twitter_post']))
            $_POST['twitter_post']      = 1;
        else
             $_POST['twitter_post']     = 0;

        if(isset($_POST['facebook_image']))
        {    $_POST['image'] = "https://graph.facebook.com/{$referenceId}/picture";
             unset($_POST['facebook_image']);
        }
            
        if(isset($_POST['twitter_image']))
        {
            $twitterDetails         = $this->session->userdata('twitter_details');
            if($twitterDetails)
            $_POST['image']         = $twitterDetails['profile_image_url'];
            unset($_POST['twitter_image']);

        }
           
        $this->editprofile_model->saveProfile($_POST,$referenceId,$reference);
        redirect('/editprofile');
     }
     /**
     * Function load the use account confirm delete pop up
     * @param  : $userId
     * @author : Vishal
     * @since  : 14-05-2012
     * @return :
     */
     function confirmDelete($userId)
     {
         $data['userId'] = $userId;
         $this->load->view('deleteAccount_view',$data);
     }
     /**
     * Function delete an user account
     * @param  :
     * @author : Vishal
     * @since  : 14-05-2012
     * @return :
     */
     function delete()
     {
         $userId        = $this->input->post('userId');
         $this->load->model('editprofile_model');
         $this->editprofile_model->deleteAccount($userId);
         redirect('/auth/logout');
         
     }
     /*
     * Function to add description for the user. Home page functionality
     * @param  : $description
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
     function addDesc()
     {
         $description   = $this->input->post('desc');
         $this->editprofile->addDesc($description);
         echo json_encode($description);

     }
     /**
     * Function not in use
     * @param
     * @author : Vishal
     * @since  : 13-03-2012
     * @return
     */
     function edit()
     {
         $this->load->model('Facebook_model');
         $email = $this->session->userdata('normal_user_email');
     }
}

/* End of file editprofile.php */
/* Location: ./application/controllers/editprofile.php */