<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
Administrator controller to handle all the admin properties

* @package pinterest clone controller
* @subpackage
* @uses : To handle  all the admin properties
* @version $id:$
* @since 22-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Administrator extends CI_Controller {

    function __construct()
	{
		parent::__construct(); 
	}

    /***************************************************LOGIN MANAGEMENT*********************************/
    /**
     * Function to handle the admin home page.
     * @param  : 
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
     public function index()
     {   
         $this->sitelogin->entryAdminCheck();
         $data['title'] = "Admin Home";
         $this->load->view('admin/admin_home_view',$data);
     }
     /**
     * Function to handle the admin login page.
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
     function login()
     {   $data['title'] = "Admin Login";
         if($_POST)
         {
            $data['username'] = $username =  $this->input->post('username');
            $data['password'] = $password = $this->input->post('password');
            $result = $this->admin_model->adminLogin($username,md5($password));
            if($result)
            {   $this->session->set_userdata('admin_login_name',$result->username);
                $this->session->set_userdata('admin_login_id',$result->id);
                $this->session->set_userdata('admin_login',1);
                $login_data = true;
            }
            else{
                $login_data = false;
            }
            echo json_encode($login_data);
         }
         else{
             $this->load->view('admin/admin_login_view',$data);
         }
     }
      /**
     * Function to handle the admin logout
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
     function logout()
     {
         $this->session->unset_userdata('admin_login');
         $this->session->unset_userdata('admin_login_id');
         $this->session->unset_userdata('admin_login_name');
         redirect('/administrator');
     }
     /***************************************************USER MANAGEMENT*********************************/
     /**
     * Function to handle the users . Display all users with edit and delete option
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
     function users($action=false)
     {   $this->sitelogin->entryAdminCheck();
         $data['title']     = 'Users';
         $data['result']    = $result = $this->admin_model->getUsers();
         $this->load->view('admin/admin_users_view',$data);

     }
      /**
     * Function to popup the edit user page
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
     function editUser($id)
     {
         $this->sitelogin->entryAdminCheck();
         $data['id']        = $id;
         $data['title']     = 'Edit users';
         $data['result']    = $result       = $this->admin_model->getUsersById($id);
         $data['emailList'] = $emailList    = $this->admin_model->getUsersEmail();
         $this->load->view('admin/admin_users_edit',$data);
     }
     /**
     * Function to save the user after edit
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
     function saveEditUser()
     {   $this->sitelogin->entryAdminCheck();
         $user['first_name'] = $this->input->post('name');
         $user['email']      = $this->input->post('email');
         $user['username']   = $this->input->post('username');
         $id                 = $this->input->post('id');
         $data['result']     = $result = $this->admin_model->saveEditUser($id,$user);
         echo json_encode($result);

     }
     /**
     * Function show popup of confirm user delete
     * @param  :$id
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
    function confirmDeleteUser($id)
    {   $this->sitelogin->entryAdminCheck();
        $data['id']         = $id;
        $data['title']      = 'Delete users';
        $this->load->view('admin/admin_users_delete',$data);
    }
    /**
     * Function delete an user account
     * @param  :
     * @author : Vishal
     * @since  : 14-05-2012
     * @return :
     */
     function deleteUser()
     {   $this->sitelogin->entryAdminCheck();
         $userId = $this->input->post('userId');
         $this->editprofile_model->deleteAccount($userId);
         echo json_encode(true);

     }
     /**
     * Function update the status of a user. block/active
     * @param  :
     * @author : Vishal
     * @since  : 14-05-2012
     * @return :
     */
     function updateUserStatus()
     {   $this->sitelogin->entryAdminCheck();
         $update['status']  =  $this->input->post('status');
         $id                = $this->input->post('id');
         $this->admin_model->updateUserStatus($update,$id);
         echo json_encode(true);
     }
     /***************************************************PIN MANAGEMENT*********************************/
     /**
     * Function to display all pins 
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
     function pin($action,$user_id=false)
     {   $this->sitelogin->entryAdminCheck();
         if($action=='view')
         {
           $data['title']                       = "Pins view";
           $this->load->library('pagination');
           if(($_POST)||($this->uri->segment(5)))
           {    if($this->input->post("search"))
                {
                    $user                       = $this->input->post("search");
                    $userArray                  = explode(' ', $user);
                    $user_id                    = $userArray[0];
                }
                else{
                    $user_id                    = $this->uri->segment(4);
                }
                $count                          = $this->admin_model->getAllPinsCount($user_id);
                $config['uri_segment']          = 5;
                $config['base_url']             = site_url('administrator/pin/view/'.$user_id);
                $offset                         = $this->uri->segment(5,0);

           }
           else{
                $count                          = $this->admin_model->getAllPinsCount();
                $config['uri_segment']          = 4;
                $config['base_url']             = site_url('administrator/pin/view/');
                $offset                         = $this->uri->segment(4,0);
                $user_id                        = false;
           }
           $config['total_rows']                = $count;
           $config['first_link']                = 'First';
           $config['per_page']                  = $limit = 30;
           
           $this->pagination->initialize($config);
           $result                              = $this->admin_model->getAllPins($user_id,$order=' id ASC',$offset,$limit);
           $data['result']                      = $result;
           $this->load->view('admin/admin_pin_view',$data);
         }
         elseif($action=='upload')
         {   $data['title']                     = "Upload view";
             $this->load->view('admin/admin_uploadpin_view',$data);
         }
         
     }
      /**
     * Function to popup the edit pin page
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
     function editPin($id)
     {   $this->sitelogin->entryAdminCheck();
         $data['id']        = $id;
         $data['title']     = 'Edit pins';
         $this->load->view('admin/admin_pins_edit',$data);
     }
     /**
     * Function to save the editted pins back to the pins table
     * @since 22-05-2012
     * @author Vishal Vijayan
     * @param  
     * @return
     */
     function saveEdittedPin()
     {   $this->sitelogin->entryAdminCheck();
         $update['description'] = $this->input->post('description');
         $update['board_id']    = $this->input->post('board');
         $update['gift']        = $this->input->post('gift');
         $update['source_url']  = $this->input->post('source');
         $id                    = $this->input->post('id');
         $this->admin_model->saveEdittedPin($update,$id);
         echo json_encode(true);
     }
     /**
     * Function to show a popup to delete the pin 
     * @param  : $id (pin id)
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
     function confirmDeletePin($id)
     {  $this->sitelogin->entryAdminCheck();
        $data['pinId']      = $id;
        $data['title']      = 'Delete Pins';
        $this->load->view('admin/admin_pins_delete',$data);
     }
     /**
     * Function delete an pin
     * @param  :
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
     function deletePin()
     {   $this->sitelogin->entryAdminCheck();
         $pinId = $this->input->post('pinId');
         $this->admin_model->deletePin($pinId);
         echo json_encode(true);
     }
      /**
     * Function get boards list based on posted user 
     * @param  :
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
     function getUserBoardList()
     {  
       
        $this->sitelogin->entryAdminCheck();
        $userId             = $this->input->post('userId');
        $boardDetails       = getUserBoard($userId);
        $select             = '<select id="board" name="board">';
        if(!empty ($boardDetails))
        {
            foreach ($boardDetails as $key => $value) {
                $select     .=  '<option value="'.$value->id.'">'.$value->board_name.'</option>';
            }
        }
        else{
            $select         .=  '<option value="invalid">Invalid user selected</option>';
        }
        
        $select             .=  '</select>';
        echo json_encode($select);
     }
     /**
     * Function save the new uploaded an pin
     * @param  :
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
     function saveUploadPin()
     {   $this->sitelogin->entryAdminCheck();
         $insert['description'] = $this->input->post('description');
         $user                  = explode(' ',$this->input->post('user'));
         $insert['user_id']     =  $user_id = $user[0];
         $insert['board_id']    = $this->input->post('board');
         $insert['type']        = $this->input->post('type');
         
         
         if($_FILES["pin"]["name"]!='')
         {   
            if ((($_FILES["pin"]["type"] == "image/gif")|| ($_FILES["pin"]["type"] == "image/jpeg")|| ($_FILES["pin"]["type"] == "image/pjpeg") || ($_FILES["pin"]["type"] == "image/png")) && ($_FILES["pin"]["size"] < 200000))
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
                $id                     = $this->admin_model->saveUploadPin($insert);
                if($id)
                {
                   $this->session->set_userdata('success_messgae','uploaded successfully');
                   redirect('administrator/pin/upload');
                }

              }
              else
              {
                 $this->session->set_userdata('success_messgae','sorry invalid image');
                 redirect('administrator/pin/upload');
              }
        }
     }
     /***************************************************CATEGORY MANAGEMENT*********************************/
      /**
     * Function to show the view/add category page
     * @param  :
     * @author : Vishal
     * @since  : 24-05-2012
     * @return
     */
     function category($action)
     {   $this->sitelogin->entryAdminCheck();
         $data['title']                 = 'Category management';
         if($action=='view')
         {
            $categoryCount              =  getcategoryList();
            $count                      =  count($categoryCount);
            $this->load->library('pagination');
            $config['uri_segment']      = 4;
            $config['base_url']         = site_url('administrator/category/view/');
            $offset                     = $this->uri->segment(4,0);
            $config['total_rows']       = $count;
            $config['first_link']       = 'First';
            $config['per_page']         = $limit = 10;
            $this->pagination->initialize($config);
            $data['category']           = $category = $this->admin_model->getCategory($limit,$offset);
            $this->load->view('admin/admin_category_view',$data);
         }
         elseif($action=='add')
         {   $data['title']             ='Add category';
             $this->load->view('admin/admin_category_add',$data);
         }
     }
     /**
     * Function to popup the edit category page
     * @param  :
     * @author : Vishal
     * @since  : 24-05-2012
     * @return
     */
     function editCategory($id)
     {   $this->sitelogin->entryAdminCheck();
         $data['id']                = $id;
         $data['title']             = 'Edit Category';
         $data['category']          = $category = $this->admin_model->getCategoryById($id);
         $this->load->view('admin/admin_category_edit',$data);
     }
     /**
     * Function to save the editted category
     * @param  :
     * @author : Vishal
     * @since  : 24-05-2012
     * @return
     */
     function saveEdittedCategory()
     {   $this->sitelogin->entryAdminCheck();
         $id                        = $this->input->post('id');
         $update['name']            = $this->input->post('name');
         $update['field']           = $this->input->post('field');
         $this->admin_model->saveEdittedCategory($id,$update);
         echo json_encode(true);
     }
     /**
     * Function to save a new category
     * @param  :
     * @author : Vishal
     * @since  : 24-05-2012
     * @return
     */
     function saveNewCategory()
     {   $this->sitelogin->entryAdminCheck();
         $insert['name']            = $this->input->post('name');
         $insert['field']           = $this->input->post('field');
         $id = $this->admin_model->saveNewCategory($insert);
         echo json_encode($id);
     }
     /**
     * Function to show a popup to delete the category
     * @param  : $id (category id)
     * @author : Vishal
     * @since  : 24-05-2012
     * @return :
     */
     function confirmDeleteCategory($id)
     {  $this->sitelogin->entryAdminCheck();
        $data['id']                 = $id;
        $data['title']              = 'Delete category';
        $this->load->view('admin/admin_category_delete',$data);
     }
     /**
     * Function delete an category
     * @param  :
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
     function deleteCategory()
     {   $this->sitelogin->entryAdminCheck();
         $id                        = $this->input->post('id');
         $this->admin_model->deleteCategory($id);
         echo json_encode(true);

     }
     /***************************************************BOARD MANAGEMENT*********************************/
     /**
     * Function to display all boards
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
     function board($action,$user_id=false)
     {   $this->sitelogin->entryAdminCheck();
         if($action=='view')
         {
           $data['title']                   = "board view";
           $this->load->library('pagination');
           if(($_POST)||($this->uri->segment(5)))
           {    if($this->input->post("search"))
                {
                    $user                    = $this->input->post("search");
                    $userArray               = explode(' ', $user);
                    $user_id                 = $userArray[0];
                }
                else{
                    $user_id = $this->uri->segment(4);
                }
                $count                      = $this->admin_model->getAllBoardsCount($user_id);
                $config['uri_segment']      = 5;
                $config['base_url']         = site_url('administrator/board/view/'.$user_id);
                $offset                     = $this->uri->segment(5,0);

           }
           else{
                $count                      = $this->admin_model->getAllBoardsCount();
                $config['uri_segment']      = 4;
                $config['base_url']         = site_url('administrator/board/view/');
                $offset                     = $this->uri->segment(4,0);
                $user_id                    = false;
           }
           $config['total_rows']            = $count;
           $config['first_link']            = 'First';
           $config['per_page']              = $limit = 30;

           $this->pagination->initialize($config);
           $result = $this->admin_model->getAllBoards($user_id,$order=' id ASC',$offset,$limit);
           $data['result']                  = $result;
           $this->load->view('admin/admin_board_view',$data);
         }
         elseif($action=='add')
         {   $data['title']                 = "Add view";
             $this->load->view('admin/admin_board_add',$data);
         }
     }
     /**
     * Function to popup the edit board page
     * @param  :
     * @author : Vishal
     * @since  : 24-05-2012
     * @return
     */
     function editBoard($id)
     {   $this->sitelogin->entryAdminCheck();
         $data['id']                    = $id;
         $data['title']                 = 'Edit board';
         $this->load->view('admin/admin_board_edit',$data);
     }
      /**
     * Function to save the editted board back to the pins table
     * @since  24-05-2012
     * @author Vishal Vijayan
     * @param
     * @return
     */
     function saveEdittedBoard()
     {   $this->sitelogin->entryAdminCheck();
         $update['description']   = $this->input->post('description');
         $update['board_name']    = $this->input->post('board_name');
         $update['category']      = $this->input->post('category');
         $id                      = $this->input->post('id');
         $this->admin_model->saveEdittedBoard($update,$id);
         echo json_encode(true);

     }
     /**
     * Function to show a popup to delete the board
     * @param  : $id (pin id)
     * @author : Vishal
     * @since  : 24-05-2012
     * @return :
     */
     function confirmDeleteBoard($id)
     {  $this->sitelogin->entryAdminCheck();
        $data['boardId']        = $id;
        $data['title']          = 'Delete Board';
        $this->load->view('admin/admin_board_delete',$data);
     }
     /**
     * Function delete an board
     * @param  :
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
     function deleteBoard()
     {   $this->sitelogin->entryAdminCheck();
         $boardId               = $this->input->post('boardId');
         $this->admin_model->deleteBoard($boardId);
         echo json_encode(true);
     }
     /**
     * Function add a new  board
     * @param  :
     * @author : Vishal
     * @since  : 25-05-2012
     * @return :
     */
     function createNewBoard()
     {   $this->sitelogin->entryAdminCheck();
         $insert['board_name']          = $this->input->post('board_name');
         $insert['board_title']         = $this->input->post('board_name');
         $insert['description']         = $this->input->post('description');
         $insert['category']            = $this->input->post('category');
         $user                          = explode(' ',$this->input->post('user'));
         $insert['user_id']             = $user[0];
         $id                            = $this->admin_model->createNewBoard($insert);
         echo json_encode($id);
      }
      /***********************************************SITE MANAGEMENT***********************************/
      /**
     * Function to edit site settings
     * @param  :
     * @author : Vishal
     * @since  : 25-05-2012
     * @return :
     */
      function settings()
      {   $this->sitelogin->entryAdminCheck();
          $data['title']                = 'Settings';
          if($_POST)
          {
            $id                         = $this->input->post('id');
            unset ($_POST['submit']);
            unset ($_POST['id']);
            $id                         = $this->admin_model->saveSettings($_POST,$id);
            echo json_encode($id);

          }
          else{
              $data['result']           = $result  = $this->admin_model->getSiteSettings();
              $this->load->view('admin/admin_settings',$data);
          }
      }
     /**
     * Function to export and import db tables
     * @param
     * @author Vishal
     * @since 21-05-2012
     */
    function dbBackup()
    {
        $this->load->helper('file');
        //Load the DB utility class
        $this->load->dbutil();
       
        //if export function
        if(isset($_POST['options']))
        {
          $prefs = array(
                'tables'      => $_POST['options'],  // Array of tables to backup.
                'ignore'      => array(),            // List of tables to omit from the backup
                'format'      => 'txt',              // gzip, zip, txt
                'filename'    => 'mybackup.sql',     // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,               // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,               // Whether to add INSERT data to backup file
                'newline'     => "\n"                // Newline character used in backup file
              );
        // Backup your entire database and assign it to a variable
        $backup               =& $this->dbutil->backup($prefs);

        //write_file('/home/dev002/Desktop/mybackup.sql', $backup);
        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('mybackup.sql', $backup);
        }

        //if import function
        if ($_FILES)
        {
          if (($_FILES["file"]["error"] > 0)||($_FILES["file"]["type"]!='text/x-sql'))
          {
            //echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
              $data['message'] = "Incorrect file format!";
          }
          else
            {
                echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                echo "Type: " . $_FILES["file"]["type"] . "<br />";
                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

                // Temporary variable, used to store current query
                $templine = '';
                // Read in entire file
                $lines = file($_FILES["file"]["tmp_name"]);
                //replace the # comment with -- comment
                $lines = str_replace('#', '--', $lines);

                // Loop through each line
                foreach ($lines as $line)
                {
                    // Skip it if it's a comment
                    if (substr($line, 0, 2) == '--' || $line == ''||substr($line, 0, 1) == '#')
                        continue;

                    // Add this line to the current segment
                    $templine .= $line;
                    // If it has a semicolon at the end, it's the end of the query
                    if (substr(trim($line), -1, 1) == ';')
                    {
                        // Perform the query
                        $this->db->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                        // Reset temp variable to empty
                        $templine = '';
                    }
                    $data['message'] = "Imported successfully!";
                }
            }
      }
      //get the db tables list for export option
      $result           = $this->db->query("show tables");
      $tables           = $result->result();
      
      $data['tables']   = $tables;
      $data['title']    = "db manager";
      $this->load->view('admin/admin_db_backup',$data);
    }
    /**
     * Function to chnage the admin user name and password
     * @param
     * @author Vishal
     * @since 21-05-2012
     */
    function password()
    {   $data['title']      = 'Password change';
        $result             = $this->admin_model->getAdminDetails();
        $data['result']     = $result;
        $this->load->view('admin/admin_login_details',$data);
        
    }
    /**
     * Function to save back the admin details
     * @param
     * @author Vishal
     * @since 21-05-2012
     */
    function saveAdminDetails()
    {
        $update['username'] = $this->input->post('username');
        $update['password'] = md5($this->input->post('password'));
        $result             = $this->admin_model->saveAdminDetails($update);
        echo json_encode(true);
    }
    /***************************************************************REPORTED PINS*************************************** */
    /**
     * Function to view the pins that are reported.
     * @param
     * @author Vishal
     * @since 21-05-2012
     */
    function reported()
    {
         $data['title']         = 'Reported Pins';
         $result                = $this->admin_model->getReportedPins();
         $data['result']        = $result;
         $this->load->view('admin/admin_pin_reported',$data);
    }

    /***************************************************AUTOCOMPLETE MANAGEMENT*********************************/
     /**
     * Function to search for the user to autocomplete the user search input box
     * @since 22-05-2012
     * @author Vishal Vijayan
     * @param  $q
     * @return
     */

     function autoComplete()
     {  $this->sitelogin->entryAdminCheck();
        $q                     = $_REQUEST['q'];
        $searchResult = $this->admin_model->search($q);
        foreach($searchResult as $key=>$row) {
            echo "<img src='$row->image' width=20px; height=20px/>"."-$row->id $row->first_name $row->last_name \n";
        }
     }
}
/* End of file administrator.php */
/* Location: ./application/controllers/administrator.php */