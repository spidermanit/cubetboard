<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Login controller for user login

* @package pinterest clone controller
* @subpackage
* @uses : To handle the user login . Normal login
* @version $id:$
* @since 02-03-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Test extends CI_Controller {
    /*
     * Function load the login page
     * @param   : $mail
     * @author  : Vishal
     * @since  : 01-03-2012
     * @return
     */
     public function index()
     {
       $data['title']  = 'Welcome';
        //if a valid login
        if(($this->session->userdata('login_user_id')))
        {
            $fb_data                = $this->session->userdata('fb_data');
            $this->load->model('Facebook_model');
            $data                   = array('fb_data' => $fb_data);//facebook data
             $data['id']            = $this->session->userdata('login_user_id');//logged user id
            $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id
            $this->load->view('welcome_test', $data);
        }
        //if invalid entry in db , call logout function by passing a paramter to set the invalid login message
        else{
            if($this->session->userdata('noentry_message'))
            {
                $data['invalid']     = $this->session->userdata('noentry_message');
                $this->session->unset_userdata('noentry_message');
            }
            $this->load->view('welcome_test', $data);
        }
     }
     function load($pinId)
     {   $data['pin'] = $pinId;
         $this->load->view('repin_view',$data);
     }
     function add()
     {    $this->board_model->test();
         //$this->load->view('add_view');
     }
     function save()
     {
         $newOrder = $_POST['ID'];
         $counter = 1;
         
         $array = $newOrder;
         array_unshift($array,"");
         unset($array[0]);
         $this->board_model->rearrangeBoard($array);
     }
     function getAllPins()
     {
         //$count = $this->board_model->getAllPins();
         //$count =  count($count);
         
         //$this->load->library('pagination');
         $userID =25;
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
            $sql .= " ORDER BY id DESC";
        }
        $sql .= " LIMIT $offset,$limit";

        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->result();

        }
        $data['row'] = $row;
        $data['title']  = 'Welcome';
        //if a valid login
        if(($this->session->userdata('login_user_id')))
        {
            $fb_data                = $this->session->userdata('fb_data');
            $this->load->model('Facebook_model');
            $data                   = array('fb_data' => $fb_data);//facebook data
             $data['id']            = $this->session->userdata('login_user_id');//logged user id
            $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id
            $data['row'] = $row;
            $data['offset'] = $nextOffset;
            $this->load->view('welcome_test', $data);
        }
        //if invalid entry in db , call logout function by passing a paramter to set the invalid login message
        else{
            if($this->session->userdata('noentry_message'))
            {
                $data['invalid']     = $this->session->userdata('noentry_message');
                $this->session->unset_userdata('noentry_message');
            }
             $data['offset'] = $nextOffset;
            $this->load->view('welcome_test', $data);
        }

     }
    
     /*
     function check()
     {
        $userId = 29;
        $referenceId                = $this->session->userdata('referenceId');
        $reference                  = $this->session->userdata('reference');
        $neededValue                = 'id';
        $data['userid']             = getUserDetails($referenceId,$reference,$neededValue);
        $login                      = $this->login_model->getProfileDetails(29,'id');
        exit();
        //$this->session->set_userdata('login_user_id', $data['userid']);

        //profile image
        if($reference=='facebook_id')
        {
            $imageUrl = "https://graph.facebook.com/".$referenceId."/picture";
        }
        elseif($reference=='twitter_id')
        {   $twitterDetails = $this->session->userdata('twitter_details');
            $imageUrl = $twitterDetails['profile_image_url'];
        }
        elseif($reference=='email')
        {
            $filename  = getcwd().'/assets/images/'.base64_encode($referenceId).'.jpeg';
            if (file_exists($filename))
                $imageUrl = getcwd().'/assets/images/'.base64_encode($referenceId).'.jpeg';
            else
               $imageUrl = getcwd().'/assets/images/'.'User.png';
        }
        //logged user details
        $userDetails = array(   'userId' => $data['userid'],
                                'name'   => $login->first_name.' '.$login->last_name,
                                'email'  => $login->email,
                                'image'  => $imageUrl
                            );
         $board = getUserBoard($userId);

         foreach ($board as $key => $value) {
             $userDetails['board'][$key] = get_object_vars($value);
         }
         
         foreach ($userDetails['board'] as $key => $value) {
            $pin = getEachBoardPins($value['id']);
            $value['content']  ='test';

         }
         
         

        //$result = array_merge($userDetails, $board);
        echo "<pre>";
        print_r($userDetails);
        echo "</pre>";


        
        //$this->session->set_userdata('userDetails',$userDetails);
        //return $this->session->userdata('userDetails');
     }
     function test()
     {  $width = 100;
        $height =100;
        $image = "https://graph.facebook.com/100001656903591/picture";
        $image_properties = getimagesize($image);
        $image_width = $image_properties[0];
        $image_height = $image_properties[1];
        $image_ratio = $image_width / $image_height;
        $type = $image_properties["mime"];
        if(!isset($width) && !isset($height)) {
            $width = $image_width;
            $height = $image_height;
        }
        if(!$width) {
            $width = round($height * $image_ratio);
        }
        if(!$height) {
            $height = round($width / $image_ratio);
        }
        if($type == "image/jpeg") {
            $thumb = imagecreatefromjpeg($image);
        } elseif($type == "image/png") {
            $thumb = imagecreatefrompng($image);
        } else {
            return false;
        }
        $temp_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($temp_image, $thumb, 0, 0, 0, 0, $width, $height, $image_width, $image_height);
        $thumbnail = imagecreatetruecolor($width, $height);
        imagecopyresampled($thumbnail, $temp_image, 0, 0, 0, 0, $width, $height, $width, $height);
        if($type == "image/jpeg") {
            header('Content-type: image/jpeg');
            imagejpeg($thumbnail);
        } else {
            header('Content-type: image/png');
            imagepng($thumbnail);
        }
        imagedestroy($temp_image);
        imagedestroy($thumbnail);
     }*/
   
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */