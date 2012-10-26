<?php
/**
Editprofile model to handles the profile functionalities of a user

* @package pinterest clone model
* @subpackage
* @uses : To handles the profile functionalities of a user
* @version $id:$
* @since 03-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Editprofile_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    /*
     * Function to a user profile details from the reference is(facebook id, twitterid, email)
     * @param  : $referenceId,$reference
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function getProfileDetails($referenceId,$reference)
    {
        $sql = "SELECT *
                    FROM
                        user
                    WHERE
                        $reference = '$referenceId'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            return $query->row();
        }
    }
    /*
     * Function to a save a user profile after edit
     * @param   : $_POST,$referenceId,$reference
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function saveProfile($_POST,$referenceId,$reference)
    {
        $this->db->where($reference, "$referenceId");
        $this->db->update('user', $_POST);
        //echo $this->db->last_query();
    }
    /*getPrimaryID
     * Function to select a needed profile detail of a user
     * @param  : $_POST,$referenceId,$reference
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function getUserDetails($referenceId,$reference,$neededValue)
    {
        $sql = "SELECT 
                    $neededValue
                FROM
                    user
                WHERE
                    $reference = '$referenceId'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row =  $query->row();
            return $row->$neededValue;
        }
    }
    /*
     * Function to a save a email settings
     * @param  : $settingsArray,$email
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function saveEmailSettings($settingsArray,$email)
    {
        $sql = "SELECT
                    email
                FROM
                    email_settings
                WHERE
                    email = '$email'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {   $this->db->where('email', "$email");
            $this->db->update('email_settings', $settingsArray);
        }
        else{
            $this->db->where('email', "$email");
            $this->db->insert('email_settings', $settingsArray);
        }
    }
     /*
     * Function to get the email settings details. To set the checkbox values of a user email settings
     * @param  : $email
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function emailSettingDetails($email)
    {
        $sql = "SELECT *
                FROM
                    email_settings
                WHERE
                    email = '$email'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row = $query->row();
            return $row;
        }
    }
     /*
     * Function to change a user password
     * @param  : $new1,$old,$reference,$referenceId
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function changePassword($new,$old,$reference,$referenceId)
    {
        $sql = "UPDATE
                    user
                SET
                    password = '$new'
                WHERE
                    password = '$old'
                AND
                    $reference = '$referenceId'";
        $query = $this->db->query($sql);
        
    }
    /*
     * Function to reset a user password
     * @param  : $pass,$reference,$email
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function resetPassword($pass,$reference,$email)
    {
        $sql = "UPDATE
                    user
                SET
                    password = '$pass'
                WHERE
                    $reference = '$email'";
        $query = $this->db->query($sql);
    }
    /*
     * Function to create a new board
     * @param  : $boardname
     * @author : Vishal
     * @since  : 10-04-2012
     * @return
     */
    function createBoard($boardname)
    {
        $sql = "SELECT
                    board_id,
                    board_name
                    category
                FROM
                    board
                WHERE
                    board_name = '$boardname'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {   $this->db->where('email', "$email");
            $this->db->update('email_settings', $array);
        }
        else{
            $this->db->where('email', "$email");
            $this->db->insert('email_settings', $array);
        }
    }
    /*
     * Function to delete a user account
     * @param  : $userid
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
    function deleteAccount($userid)
    {
        /*Delete from user table*/
        $this->db->where('id', $userid);
        $this->db->delete('user');

        /*Delete from activity table*/
        $this->db->where('user_id', $userid);
        $this->db->delete('activity');

        /*Delete from board table*/
        $this->db->where('user_id', $userid);
        $this->db->delete('board');

        /*Delete from comments table*/
        $this->db->where('user_id', $userid);
        $this->db->delete('comments');

        

         /*Delete from likes table*/
        $this->db->where('source_user_id', $userid);
        $this->db->delete('likes');

         /*Delete from likes table*/
        $this->db->where('like_user_id', $userid);
        $this->db->delete('likes');

         /*Delete from pins table*/
        $this->db->where('user_id', $userid);
        $this->db->delete('pins');

         /*Delete from repin table*/
        $this->db->where('repin_user_id', $userid);
        $this->db->delete('repin');

         /*Delete from repin table*/
        $this->db->where('owner_user_id', $userid);
        $this->db->delete('repin');

        $this->db->where('is_following', $userid);
        $this->db->delete('follow');

        $this->db->where('user_id', $userid);
        $this->db->delete('follow');

        $this->db->where('user_id', $userid);
        $this->db->delete('report_pins');
    }
    /*
     * Function to add description for the user. Home page functionality
     * @param  : $description
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
    function addDesc($description)
    {
        $sql = "UPDATE 
                        user
                    SET
                        description = '$description'
                    WHERE
                        id = {$this->session->userdata('login_user_id')}";
        $query      = $this->db->query($sql);
    }
}