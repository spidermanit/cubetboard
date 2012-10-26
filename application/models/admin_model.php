<?php
/**
Action model to handles the administrative functions

* @package pinterest clone model
* @subpackage
* @uses : To handle all the  actions of a pin. Email, embed , report
* @version $id:$
* @since 03-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Admin_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    /**
     * Function to handle the admin login page.
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
    function adminLogin($username,$password)
    {
        $sql = "SELECT * 
                    FROM
                        admin_users
                    WHERE
                        username='$username'
                    AND
                        password='$password' ";
        $query      =  $this->db->query($sql);
        if($query->num_rows>0)
        {   $row    =  $query->row();
            return $row;
        }
        else{
            return false;
        }
    }
     /**
     * Function to handle the users . Display all users with edit and delete option
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
    function getUsers()
    {
        $sql = "SELECT *
                    FROM
                        user";
        $query =  $this->db->query($sql);
        if($query->num_rows>0)
        {  
            return $query->result();
        }
        else{
            return false;
        }
    }
    /**
     * Function to get user details by id
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
    function getUsersById($id)
    {
        $sql= "SELECT *
                    FROM
                        user
                    WHERE
                        id = {$id}";
        $query =  $this->db->query($sql);
        if($query->num_rows>0)
        {
            return $query->row();
        }
        else{
            return false;
        }
    }
      /**
     * Function to save the user after edit
     * @param  :
     * @author : Vishal
     * @since  : 22-05-2012
     * @return
     */
    function saveEditUser($id,$user)
    {
        $this->db->where('id',$id);
        $this->db->update('user',$user);
        return true;
    }
    /**
     * Function to all pins from the pin table, may or may not user id provided
     * @since 03-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userID;
     * @return <int> id
     */
    function getAllPins($userID=false,$order=false,$offset,$limit)
    {
        $sql = "SELECT * 
                    FROM
                        pins";

        if($userID)
            $sql .= " WHERE 
                        user_id = $userID ";

        if($order)
        {
            $sql .= " ORDER BY
                        ' $order'";
        }
        else{
            $sql .= " ORDER BY
                        RAND()";
        }
        $sql.=" LIMIT $offset,$limit";


        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->result();
            return $row;
        }
    }
    /**
     * Function to get the count of pins from pins table based on userid or get all the pins count irrespective of user
     * @since 22-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userid;
     * @return 
     */
    function getAllPinsCount($userid=false)
    {
        if($userid)
        {
            $this->db->select('id');
            $this->db->where('user_id',$userid);
            $query = $this->db->get('pins');
            return $query->num_rows();
        }
        else{
            return $this->db->count_all('pins');
        }
        
    }
    /**
     * Function to get all the email ids of the users from user table.
     * @since 22-05-2012
     * @author Vishal Vijayan
     * @param 
     * @return
     */
    function getUsersEmail()
    {
        $this->db->select('email');
        $query = $this->db->get('user');
        $result =  $query->result();
        foreach ($result as $key => $value) {
            $return[$key]=$value->email;
        }
        return $return;
    }
    /**
     * Function to save the editted pins back to the pins table
     * @since 22-05-2012
     * @author Vishal Vijayan
     * @param  $update,$id
     * @return
     */
    function saveEdittedPin($update,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('pins', $update);
        return true;
    }
     /**
     * Function to search for the user to autocomplete the user search input box
     * @since 22-05-2012
     * @author Vishal Vijayan
     * @param  $q
     * @return
     */
    function search($q)
    {
        $sql = "SELECT 
                        id,
                        image,
                        first_name,
                        last_name
                FROM
                        user
                WHERE
                        first_name like '%$q%'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    /**
     * Function delete an pin
     * @param  : $pinId
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function deletePin($pinId)
    {

        $this->db->where('new_pin_id', $pinId);
        $this->db->delete('repin');

        $this->db->where('from_pin_id', $value->id);
        $this->db->delete('repin');

        $this->db->where('action_id', $pinId);
        $this->db->delete('activity');

       

        $this->db->where('pin_id', $pinId);
        $this->db->delete('comments');

        $this->db->where('pin_id', $pinId);
        $this->db->delete('likes');

        $this->db->where('id', $pinId);
        $this->db->delete('pins');

        $this->db->where('pin_id', $pinId);
        $this->db->delete('report_pins');

        $sql = "DELETE FROM pins WHERE id=$pinId";
        $this->db->query($sql);
        return true;
    }
    /**
     * Function the uploaded pin
     * @param  : $insert
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function saveUploadPin($insert)
    {
        $this->db->insert('pins', $insert);
        return $this->db->insert_id();
    }
    /**
     * Function to get the category
     * @param  : $insert
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function getCategory($limit,$offset)
    {
        $sql    = "SELECT
                        *
                    FROM
                        category_list
                    LIMIT $offset,$limit";
        $query  = $this->db->query($sql);
        return $query->result();
    }
    /**
     * Function to get the category by id
     * @param  : $id
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function getCategoryById($id)
    {
        $sql    = "SELECT
                        *
                    FROM
                        category_list
                    WHERE
                        id=$id";
        $query  = $this->db->query($sql);
        return $query->row();
    }
    /**
     * Function to save the editted category
     * @param  : $id,$update
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function saveEdittedCategory($id,$update)
    {
        $this->db->where('id', $id);
        $this->db->update('category_list', $update);
        return true;
    }
    /**
     * Function to save the new category
     * @param  : $insert
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function saveNewCategory($insert)
    {
        $this->db->insert('category_list', $insert);
        return $this->db->insert_id();
    }
     /**
     * Function to delete a category
     * @param  : $id
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function deleteCategory($id)
    {
        $sql = "DELETE FROM category_list WHERE id=$id";
        $this->db->query($sql);
        return true;
    }
    /**
     * Function to get the count of boards
     * @param  : $userId
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function getAllBoardsCount($userId=false)
    {

        if($userId)
        {
            $this->db->select('id');
            $this->db->where('user_id',$userId);
            $query = $this->db->get('board');
            return $query->num_rows();
        }
        else{
            return $this->db->count_all('board');
        }
    }
    /**
     * Function to get all boards
     * @param  : $userID=false,$order=false,$offset,$limit
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function getAllBoards($userID=false,$order=false,$offset,$limit)
    {
        $sql = "SELECT * from board";

        if($userID)
            $sql .= " WHERE user_id= $userID ";

        if($order)
        {
            $sql .= " ORDER BY
                        ' $order'";
        }
        else{
            $sql .= " ORDER BY
                        RAND()";
        }
        $sql.=" LIMIT $offset,$limit";


        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->result();
            return $row;
        }
    }
    /**
     * Function to save the editted board
     * @param  : $update,$id
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function saveEdittedBoard($update,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('board', $update);
        return true;
    }
    /**
     * Function to delete a board
     * @param  : $boardId
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function deleteBoard($boardId)
    {

        $sql    = "SELECT
                        *
                    FROM
                        pins
                    WHERE
                        board_id = $boardId";
        $query  = $this->db->query($sql);
        $pinDetails =  $query->row();
        foreach ($pinDetails as $key => $value) {
            $this->db->where('new_pin_id', $value->id);
            $this->db->delete('repin');

            $this->db->where('from_pin_id', $value->id);
            $this->db->delete('repin');

            $this->db->where('action_id', $value->id);
            $this->db->delete('activity');

            
            $this->db->where('pin_id', $value->id);
            $this->db->delete('comments');

            $this->db->where('pin_id', $value->id);
            $this->db->delete('likes');

            $this->db->where('id', $value->id);
            $this->db->delete('pins');

           

        }
        $sql = "DELETE FROM board WHERE id=$boardId";
        $this->db->query($sql);

        $this->db->where('is_following_board_id', $boardId);
        $this->db->delete('follow');

        $this->db->where('board_id', $boardId);
        $this->db->delete('report_pins');
        
        return true;
    }
    /**
     * Function to update a user status
     * @param  : $update,$id
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function updateUserStatus($update,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $update);
        return true;
    }
    /**
     * Function to create a new board
     * @param  : $insert
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function createNewBoard($insert)
    {
        $this->db->insert('board', $insert);
        return $this->db->insert_id();
    }
    /**
     * Function to get the current settings of the site
     * @param  :
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function getSiteSettings()
    {
        $sql = "SELECT * FROM config";
        $query  = $this->db->query($sql);
        return $query->row_array();

    }
    /**
     * Function to save the settings of the site
     * @param  :
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function saveSettings($_POST,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('config', $_POST);
        return true;
    }
    /**
     * Function to get the pins reported
     * @param  :
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function getReportedPins()
    {
        $sql = "select * from report_pins";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else{
            return false;
        }
    }
     /**
     * Function to get details of a admin
     * @param  :
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function getAdminDetails()
    {
        $sql = "SELECT *
                    FROM
                        admin_users
                    WHERE
                        id = {$this->session->userdata('admin_login_id')}";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {   $row = $query->row();
            return $row;
        }
        else{
            return false;
        }
    }
    /**
     * Function to save back the admin details
     * @param  : $update
     * @author : Vishal
     * @since  : 23-05-2012
     * @return :
     */
    function saveAdminDetails($update)
    {
        $this->db->where('id', $this->session->userdata('admin_login_id'));
        $this->db->update('admin_users', $update);
        return true;
    }
}
?>