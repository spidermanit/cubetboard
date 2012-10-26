<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
Follow controller to handles the follow of a user

* @package pinterest clone controller
* @subpackage
* @uses : To handle all the follow of a user
* @version $id:$
* @since 03-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Follow extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}

    /**
     * Function to follow all the boards of a user
     * @param  : <Int> $id
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
     public function all($id=false)
	 {
        //get the id of the user that we are planning to follow all his board.
         $id = $this->input->post('id');
         //reset of the functialities are handeled in the model
         $this->action_model->followAll($id);
         echo json_encode($value=true);

     }
      /**
     * Function to un follow all the boards of a user
     * @param  : <Int> $id
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
     public function unFollowAll($id=false)
     {
         //get the id of the user that we are planning to un follow all his board.
         $id = $this->input->post('id');
         //reset of the functialities are handeled in the model
         $this->action_model->unFollowAll($id);
         //redirect('user/index/'.$id);
         echo json_encode($value=true);
     }

     /**
     * Function to save the follow functionality . Follow a single board
     * @param  : <Int> is_following,$is_following_board_id
     * @param  : <string> $follow_type
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
     function saveFollow($is_following,$is_following_board_id,$follow_type=false)
     {  
         $arrayFollow['user_id']                = $this->session->userdata('login_user_id');
         $arrayFollow['is_following']           = $is_following;
         $arrayFollow['is_following_board_id']  = $is_following_board_id;
         $this->action_model->saveFollow($arrayFollow);
         $boardDetails = getBoardDetails($is_following_board_id);
         $activity = array(
                    'user_id'   =>  $this->session->userdata('login_user_id'),
                    'log'       =>  "Following the board ".$boardDetails->board_name,
                    'type'      =>  "follow_board",
                    'action_id' =>  $is_following_board_id
        );
         activityList($activity);
         redirect('board/index/'.$is_following_board_id);
     }
     /**
     * Function to save the un follow functionality . Un follow a single board
     * @param  : <Int> is_following,$is_following_board_id
     * @param  : <string> $follow_type
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
     function saveUnFollow($is_following,$is_following_board_id,$follow_type=false)
     {
         $arrayFollow['user_id']                = $this->session->userdata('login_user_id');
         $arrayFollow['is_following']           = $is_following;
         $arrayFollow['is_following_board_id']  = $is_following_board_id;
         $this->action_model->saveUnFollow($arrayFollow);
         $boardDetails = getBoardDetails($is_following_board_id);
         $activity = array(
                    'user_id'   =>  $this->session->userdata('login_user_id'),
                    'log'       =>  "Unfollows the board ".$boardDetails->board_name,
                    'type'      =>  "follow_board",
                    'action_id' =>  $is_following_board_id
        );
         activityList($activity);
         redirect('board/index/'.$is_following_board_id);
         
     }
     /**
     * Function to save the follow/unfollw a single board using ajax
     * @param  :
     * @param  : <string> $follow_type
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
     function saveFollowUnfollow()
     {

         $arrayFollow['user_id']                = $this->session->userdata('login_user_id');
         $arrayFollow['is_following']           = $this->input->post('is_following');
         $arrayFollow['is_following_board_id']  = $this->input->post('is_following_board_id');
         if($this->input->post('action')=='follow')
         {   $boardDetails = getBoardDetails($this->input->post('is_following_board_id'));
             $activity = array(
                        'user_id'   =>  $this->session->userdata('login_user_id'),
                        'log'       =>  "Following the board ".$boardDetails->board_name,
                        'type'      =>  "follow_board",
                        'action_id' =>  $this->input->post('is_following_board_id')
            );
             activityList($activity);
             $this->action_model->saveFollow($arrayFollow);
         }
         else{
             $boardDetails = getBoardDetails($this->input->post('is_following_board_id'));
             $activity = array(
                        'user_id'   =>  $this->session->userdata('login_user_id'),
                        'log'       =>  "Unfollows the board ".$boardDetails->board_name,
                        'type'      =>  "follow_board",
                        'action_id' =>  $this->input->post('is_following_board_id')
            );
             activityList($activity);
             $this->action_model->saveUnFollow($arrayFollow);
         }
         echo json_encode(true);
     }
     /**
     * Function to list all the followers of a user [The people who watch YOUR/GIVEN USER status.]
     * @param  : <Int> $id
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
     function followers($id)
     {  $data['title']              = 'Followers';
        $data['id']                 = $id;
        $data['id']                 = $id = $id?$id:$this->session->userdata('loged_in_user');
        $data['userDetails']        = $userDetails = userDetails($data['id']);//logged user details from user id
        $this->load->view('followers_view',$data);
     }
     /**
     * Function to list all the user's following. [The people YOU are watching]
     * @param  : <Int> $id
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
     function following($id)
     {  $data['title']          = 'Following';
        $data['id']             = $id;
        $data['id']             = $id = $id?$id:$this->session->userdata('loged_in_user');
        $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id
        $this->load->view('following_view',$data);
     }
}
/* End of file follow.php */
/* Location: ./application/controllers/follow.php */