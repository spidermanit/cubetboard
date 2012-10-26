<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
pin controller to display all pins of a user

* @package pinterest clone controller
* @subpackage
* @uses : To handle all pins of a user irrespective of boards
* @version $id:$
* @since 13-04-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Pins extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}

    /**
     * Function to load each board induvidualy and displays the pins in it
     * @param
     * @author : Vishal
     * @since  : 22-03-2012
     * @return
     */
     public function index($id=false)
	 {       
         $data['title']          = "All pins";
         $data['id']             = ($id)?$id:$this->session->userdata('login_user_id');//logged user id
         $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id

         if(empty ($userDetails))
            redirect();

         $this->load->view('allpins_view',$data);
     }
     /**
     * Function to save the likes of a pin
     * @param
     * @author : Vishal
     * @since  : 22-03-2012
     * @return
     */
     function saveLikes()
     {
         $like = $_POST;
         $id = $this->board_model->saveLikes($like);
         $activity = array(
                            'user_id'   =>  $this->session->userdata('login_user_id'),
                            'log'       =>  "Liked a pin  ",
                            'type'      =>  "like",
                            'action_id' =>  $like['pin_id']
         );
         activityList($activity);
         $count = getPinLikeCount($like['pin_id']);
         echo json_encode($count);
     }
     /**
     * Function to save the un likes of a pin
     * @param
     * @author : Vishal
     * @since  : 22-03-2012
     * @return
     */
     function unLike()
     {
         $like          = $_POST;
         $id            = $this->board_model->unLikes($like);

         $activity      = array(
                            'user_id'   =>  $this->session->userdata('login_user_id'),
                            'log'       =>  "Un liked a pin  ",
                            'type'      =>  "like",
                            'action_id' =>  $like['pin_id']
         );
         activityList($activity);
         $count        = getPinLikeCount($like['pin_id']);
         echo json_encode($count);
     }
     /**
     * Function list all pins that comes under same source irrespective of user and board
     * @param  : $source
     * @author : Vishal
     * @since  : 26-04-2012
     * @return
     */
     function source($source=false)
     {
       $data['title']          = 'Source pins';
       $source                 = base64_decode($source);
       $data['source']         = $source?$source:'';
       $data['id']             = (isset($id))?$id:$this->session->userdata('login_user_id');//logged user id
       $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id
       $this->load->view('source_pins',$data);
     }
     /**
     * Function list all pins that comes under same type irrespective of user and board
     * @param  : $source
     * @author : Vishal
     * @since  : 26-04-2012
     * @return
     */
     function videos($id=false)
     { $data['title']          = 'Videos';
       $data['id']             = $id = $id?$id:$this->session->userdata('loged_in_user');
       $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id
       
       $this->load->view('videopins_view',$data);
     }
     /**
     * Function load the confirm delete pin pop up page
     * @param  : $_POST
     * @author : Vishal
     * @since  : 10-05-2012
     * @return :
     */
     function confirmDelete($boardId,$pinId)
     {
         $data['boardId']   = $boardId;
         $data['pinId']     = $pinId;
         $this->load->view('deletePin_popup',$data);
     }
      /**
     * Function to delete a pin based on pin id and board id
     * @param  : $_POST
     * @author : Vishal
     * @since  : 10-04-2012
     * @return :
     */
     function deletePin()
     {
         $pinId             = $this->input->post('pinId');
         $boardId           = $this->input->post('boardId');
         $this->board_model->deletePin($pinId,$boardId);
         echo json_encode(true);
     }
     function uploadPins()
     {  $data['title'] = 'upload a pin';
         $this->load->view('upload_pin_view',$data);
     }
     /**
     * Function save the new uploaded an pin
     * @param  :
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
     function saveUploadPin()
     {
         $insert['description']     = $this->input->post('description');
         $insert['user_id']         =  $user_id = $this->session->userdata('login_user_id');
         $insert['board_id']        = $boardId = $this->input->post('board_id');
         $insert['type']            = $this->input->post('type');

         
         if($_FILES["pin"]["name"]!='')
         {
            if ((($_FILES["pin"]["type"] == "image/gif")|| ($_FILES["pin"]["type"] == "image/jpeg")|| ($_FILES["pin"]["type"] == "image/pjpeg") || ($_FILES["pin"]["type"] == "image/png")|| ($_FILES["pin"]["type"] == "image/PNG")|| ($_FILES["pin"]["type"] == "image/GIF")|| ($_FILES["pin"]["type"] == "image/JPG")|| ($_FILES["pin"]["type"] == "image/JPEG")))
            {
                if ($_FILES["pin"]["error"] > 0)
                {
                    echo "Return Code: " . $_FILES["pin"]["error"] . "<br />";
                }
                else
                {
                    $image          = $_FILES["pin"]["name"];
                    $ext            = explode('/', $_FILES["pin"]["type"]);
                    $image          = time().'_'.$image;
                    $dir = getcwd()."/application/assets/pins/$user_id";
                    if(file_exists($dir) && is_dir($dir))
                    {

                    }
                    else{

                        mkdir(getcwd()."/application/assets/pins/$user_id",0777);
                    }
                    move_uploaded_file($_FILES["pin"]["tmp_name"],
                    getcwd()."/application/assets/pins/$user_id/" . $image);
                    $image = site_url("/application/assets/pins/$user_id/".$image);

                }
                $insert['pin_url']      = $image;
                $insert['source_url']      = '';
                $id= $this->board_model->saveUploadPin($insert);
                if($id)
                {
                   redirect('board/pins/'.$boardId.'/'.$id);
                }

              }
              else
              {
                 redirect('board/index/'.$boardId);
              }
        }
     }
}
/* End of file pins.php */
/* Location: ./application/controllers/pins.php */