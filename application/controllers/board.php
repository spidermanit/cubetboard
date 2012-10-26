<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
  Board controller to create a new board
* @package pinterest clone controller
* @subpackage
* @uses : To handle to create a new board and display induvidual boardss
* @version $id:$
* @since 02-03-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Board extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        //$this->sitelogin->entryCheck();
        $this->load->helper('url');
        $this->load->helper('pinterest_helper');
		$this->load->model('board_model');
        $this->load->model('facebook_model');
	}

    /**
     * Function to load each board induvidualy and displays the pins it it
     * @param
     * @author : Vishal
     * @since  : 22-03-2012
     * @return
     */
     public function index($id=false)
	 {   $this->sitelogin->entryCheck();
         $data['title']         = "Board pins";
         $this->load->helper('pinterest_helper');
         $this->load->model('board_model');
         if($id)
         {
             $data['result']    = $result = $this->board_model->getEachBoardPins($id);
             $data['boardId']   = $id;
             $this->load->view('board_view',$data);
         }
         else{
             redirect();
         }
	 }
     
     /**
     * Function to create a new board
     * @param
     * @author : Vishal
     * @since  : 26-03-2012
     * @return
     */
     function create()
     {  $this->sitelogin->entryCheck();
        unset($_POST['csrfmiddlewaretoken']);
        unset($_POST['submit']);

        
        $this->load->helper('pinterest_helper');
        //get reference and reference id
        $referenceId                    = $this->session->userdata('referenceId');
        $reference                      = $this->session->userdata('reference');

        //get current user id
        $neededValue                    = 'id';
        $id                             = getUserDetails($referenceId,$reference,$neededValue);

        //prepare borad details to save
        $valueArray                     = array();
        $valueArray['user_id']          = $id;
        $valueArray['board_name']       = $_POST['name'];
        $valueArray['who_can_tag']      = (isset($_POST['change_BoardCollaborators']))?$_POST['change_BoardCollaborators']:'';
        $valueArray['board_title']      = $_POST['name'];
        $valueArray['category']         = $_POST['category'];
        $valueArray['collaborator']     = isset($_POST['collaborator_name'])?$_POST['collaborator_name']:'';
        $valueArray['board_position']   = highestBoard($id)+1;
        $this->load->model('board_model');
        $boardId = $this->board_model->createBoard($valueArray);//update password
        if(isset($_POST['type']))
        {
            echo json_encode($boardId);
        }
        else
        redirect('/user/index/'.$id);
     }
     /**
     * Function to load the edit page of a board
     * @param
     * @author : Vishal
     * @since  : 29-03-2012
     * @return
     */
     function edit($id)
     {   $this->sitelogin->entryCheck();
         $data['boardId'] = $id;
         $this->load->view('editboard_view',$data);
     }
     /**
     * Function save the board values after edit
     * @param
     * @author : Vishal
     * @since  : 30-03-2012
     * @return
     */
     function editSave()
     {   $this->sitelogin->entryCheck();
         unset($_POST['csrfmiddlewaretoken']);
         unset($_POST['submit']);
         unset($_POST['collaborator_username']);


        $this->load->helper('pinterest_helper');
        //get reference and reference id
        $referenceId                    = $this->session->userdata('referenceId');
        $reference                      = $this->session->userdata('reference');
        //get current user id
        $neededValue                    = 'id';
        $id                             = getUserDetails($referenceId,$reference,$neededValue);

        //prepare borad details to save
        $boardId                        = $_POST['boardId'];
        $valueArray                     = array();
        $valueArray['user_id']          = $id;
        $valueArray['board_name']       = $_POST['name'];
        $valueArray['who_can_tag']      = (isset($_POST['edit_change_BoardCollaborators']))?$_POST['edit_change_BoardCollaborators']:'';
        $valueArray['board_title']      = $_POST['name'];
        $valueArray['category']         = $_POST['category'];
        $valueArray['collaborator']     = isset($_POST['collaborator_name'])?$_POST['collaborator_name']:'';
        $this->load->model('board_model');
        $return                         = $this->board_model->editSaveBoard($boardId,$valueArray);//update password
        echo json_encode($return);
     }
     /**
     * Function to a insert comments for each pins
     * @param   :
     * @author : Vishal
     * @since  : 29-03-2012
     * @return
     */
     function addComment($induvidual=false)
     {
         $this->sitelogin->entryCheck();
         $array['user_id']  = $this->session->userdata('login_user_id');
         $array['pin_id']   = $this->input->post('id');
         $array['comments'] = $this->input->post('comment');
         $lastInsertId      = $this->board_model->insertPinComments($array);
         
         $loggedUserDetails = userDetails();
         $name              = $loggedUserDetails['name'];
         $id                = $loggedUserDetails['userId'];
         $image             = $loggedUserDetails['image'];
         $link              = site_url('user/index/'.$id);
         //induvidual meant for, we are adding a comment from an induvidual pin page
         if($induvidual)
         {
             $addDiv = '<div class="comment" style="background-color: rgb(242, 240, 240);">

                                <a data='.$lastInsertId.' href="board/deletecomment/'.$lastInsertId.'" title="Remove Comment" class="DeleteComment floatRight tipsyHover">X</a>
                                <a class="CommenterImage" href='.$link.'><img alt="Thumbnail of '.$name.'" src='.$image.'></a>
                                <p class="CommenterMeta"><a class="CommenterName" href='.$link.'>'.$name.'</a><br>'.$array['comments'].'</p>

                            </div>';

         }
         //we are adding comments from a pin board page, where all pins of that board are displayed
         else{
             $addDiv = '<div comment-id="18577623340816386" class="comment convo clearfix">
                                <a class="ImgLink" href='.$link.'>
                                    <img alt="Picture of '.$name.'" src='.$image.'>
                                </a>
                                <p><a href='.$link.'>'.$name.'</a> '.$array['comments'].'</p>
                            </div>';
         }
         $count[0]      = count(getPinComments($array['pin_id']));
         $count[1]      = $lastInsertId;
         echo json_encode($count);

     }
     /**
     * Function to delete a board
     * @param  :
     * @author : Vishal
     * @since  : 29-03-2012
     * @return
     */
     function delete()
     {   $this->sitelogin->entryCheck();
         $boardId           =  $_POST['board'];
         $this->load->model('board_model');
         $return            = $this->board_model->deleteBoard($boardId);//update password
         echo json_encode(true);
     }

     /**
     * Function to display the induvidual post from board id and pin id
     * @param  : $boardId,$pinId
     * @author : Vishal
     * @since  : 02-04-2012
     * @return
     */
     function pins($boardId,$pinId,$action=false)
     {   $data['title']     = 'Pin page';
         $data['boardId']   = $boardId;
         $data['pinId']     = $pinId;
         if($action=='view')
         {
             $this->load->view('pinpage_view',$data);
         }
         else{
             $this->sitelogin->entryCheck();
             $this->load->view('pinpage_normal',$data);
         }
     }
     function pinsTest($boardId,$pinId,$action=false)
     {   $data['title']     = 'Pin page';
         $data['boardId']   = $boardId;
         $data['pinId']     = $pinId;
         if($action=='view')
         {
             $this->load->view('test',$data);
         }
         else{
             $this->load->view('pinpage_normal',$data);
         }
     }
     /**
     * Function to delete a comment of a pin
     * @param  :
     * @author : Vishal
     * @since  : 02-04-2012
     * @return
     */
     function deleteComment()
     {   $this->sitelogin->entryCheck();
         $commentId     = $this->input->post('id');
         $return        = $this->board_model->deleteComment($commentId);//update password
         echo json_encode($value=true);
     }
     
     /**
     * Function save the details for a reported pin
     * @param  : $reportArray
     * @author : Vishal
     * @since  : 19-04-2012
     * @return : int
     */
     function reportPin()
     {
         $this->sitelogin->entryCheck();
         $reportArray                           = array();
              
         $reportArray['user_id']                = $userId       = $this->session->userdata('login_user_id');
         $reportArray['pin_id']                 = $pinId        = $this->input->post('pinId');
         $reportArray['board_id']               = $boardId      = $this->input->post('boardId');
         $reportArray['reason']                 = $reason       = $this->input->post('reason').($this->input->post('ReportPin')?('-'.$this->input->post('ReportPin')):'');

         $return                                = $this->board_model->reportPin($reportArray);

         $userDetails                           = userDetails($userId);
         $pinDetails                            = getPinDetails($pinId);
         $owner                                 = userDetails($pinDetails->user_id);

         /*Email*/
         $this->load->library('email');
         $config['mailtype']                    = 'html';
         $config['wordwrap']                    = true;
         $this->email->initialize($config);
         $this->email->from('info@pinterestclone', 'Pinterest');
         $message                               = "Pin is reported from the user";
         $pinDetails                            =  'Reported by: '.$userDetails['userId'].'-'.$userDetails['name'].' pin id : '.$pinId.' Board id: '.$boardId.' Pin owner: '.$owner['userId'].'-'.$owner['name'];
         $msg                                   = 'reason : ' .$reason.'<br/>'.$pinDetails;
         $message                               = $message.'<br/>'.$msg;
         $this->email->to($this->config->item('admin_email'));
         $this->email->subject('Pin is reported');
         $this->email->message($message);
         $this->email->send();

         echo json_encode($return);
     }
     /**
     * Function send email about the pin to a friend
     * @param  : $reportArray
     * @author : Vishal
     * @since  : 19-04-2012
     * @return : 
     */
     function email()
     {   
         $this->sitelogin->entryCheck();
         $name                      = $this->input->post('name');
         $email                     = $this->input->post('email');
         $link                      = $this->input->post('pinLink');
         $message                   = $this->input->post('MessageBody')?$this->input->post('MessageBody'):'';
       
         $this->load->library('email');
         $config['mailtype']        = 'html';
         $config['wordwrap']        = true;
         $this->email->initialize($config);
         $this->email->from('info@pinterestclone', 'Pinterest');
         $msg                       = 'Hai '.$name.'<br/>'.'Checkout the new exiting pin in pinterest';
         $message                   = $msg.'<br/>'.$message.'<br/>'.$link;
         $this->email->to($email);
         $this->email->subject('Check out the pininterest pin');
         $this->email->message($message);
         $this->email->send();

         echo json_encode(true);
     }
     /**
     * Function load the pin edit page
     * @param  : $boardId,$pinId
     * @author : Vishal
     * @since  : 10-04-2012
     * @return :
     */
     function pinEdit($boardId,$pinId)
     {   $this->sitelogin->entryCheck();
         $data['title']     = "Edit pin";
         $data['boardId']   = $boardId;
         $data['pinId']     = $pinId;
         $data['userId']    = $this->session->userdata('login_user_id');
         $data['result']    = getPinDetails($pinId,$boardId);
         $this->load->view('editPin_view',$data);
     }
     /**
     * Function save the editted pin details back to pins table and to redirect to the new pin page
     * @param  : $_POST
     * @author : Vishal
     * @since  : 10-04-2012
     * @return :
     */
     function savePin()
     {
         $this->sitelogin->entryCheck();
         $pinArray                = array();
         $pinArray['description'] = $this->input->post('details');
         $pinArray['source_url']  = $this->input->post('link');
         $pinArray['board_id']    = $newBoardId = $this->input->post('board');
         $pinArray['gift']        = $this->input->post('gift')?$this->input->post('gift'):0;
        
         $oldBoardId              = $this->input->post('oldBoardId');
         $pinId                   = $this->input->post('pinId');
         $return                  = $this->board_model->saveEditPin($pinId,$pinArray);
         redirect('board/pins/'.$newBoardId.'/'.$pinId);
     }
    
     /**
     * Function load the add board pop up page
     * @param  : $_POST
     * @author : Vishal
     * @since  : 10-05-2012
     * @return :
     */
     function add()
     {   $this->sitelogin->entryCheck();
         $this->load->view('add_view');
     }
     /**
     * Function load the confirm delete board pop up page
     * @param  : $_POST
     * @author : Vishal
     * @since  : 10-05-2012
     * @return :
     */
     function confirmDelete($boardId)
     {   $this->sitelogin->entryCheck();
         $data['boardId'] = $boardId;
         $this->load->view('deleteBoard_popup',$data);
     }
     /**
     * Function rearrange the board
     * @param  : $_POST
     * @author : Vishal
     * @since  : 10-05-2012
     * @return :
     */
     function rearrange()
     {   $this->sitelogin->entryCheck();
         $newOrder      = $_POST['ID'];
         $counter       = 1;

         $array         = $newOrder;
         array_unshift($array,"");
         unset($array[0]);
         $this->board_model->rearrangeBoard($array);
     }
     function followers($boardId)
     {   $this->sitelogin->entryCheck();
         $data['boardId'] = $boardId;
         $this->load->view('board_followers',$data);
     }
     function boardView($id)
     {   $this->sitelogin->entryCheck();
         $data['id'] = $id;
         $this->load->view('user_boards',$data);
     }
}
/* End of file board.php */
/* Location: ./application/controllers/board.php */