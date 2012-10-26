<?php
/**
Login model to handles the login functionalities

* @package pinterest clone model
* @subpackage
* @uses : To handles the login functionalities
* @version $id:$
* @since 03-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Login_model extends CI_Model {

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
     * Function to get the logged user details
     * @param  : $referenceId,$reference
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function getLogedUsers($referenceId,$reference)
    {
        $sql = "SELECT *
                    FROM
                        user
                    WHERE
                        $reference = '$referenceId'
                    AND
                        verification = 'done'
                    AND
                        status = 1";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            return $query->row();
        }
    }
    /*
     * Function to verify a user
     * @param  : $email,$code
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function verify($email,$code)
    {
        $sql = "SELECT id
                FROM
                    user
                WHERE
                    verification = '$code'
                AND
                    email='$email'
                ";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row =  $query->row();
            $update['verification'] = 'done';
            $update['status']       = 1;
            $this->db->where('id', $row->id);
            $this->db->update('user', $update);
            return $row->id;
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
     * Function to create a board. Function not in use
     * @param  : $boardname
     * @author : Vishal
     * @since  : 20-03-2012
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
     * Function to insert a facebook id of newly invited user. For app request new logic. Function currently not in use
     * @param  : $idArray
     * @author : Vishal
     * @since  : 10-05-2012
     * @return
     */
    function insertInvitedId($idArray)
    {   $return = "";
        foreach ($idArray as $value) {
            $this->db->like('facebook_id', $value);
            $this->db->from('user');
            $count = $this->db->count_all_results();
            if($count>0)
            {   /*
                $this->db->select('email');
                $this->db->where('facebook_id', $value);
                $query = $this->db->get('user');
                $result = $query->row();
                if($result->num_rows()>0)
                {
                    if($result->email!='')
                    {

                    }
                    else{

                    }
                }
                else{
                    $this->db->set('facebook_id', $value);
                    $this->db->insert('user'); 
                }*/
                $return .=$value.' already inserted'.'/n';
            }
            else{
                $this->db->set('facebook_id', $value);
                $this->db->insert('user');
                $return .=$value.' inserted'.'/n';
            }

        }
        return $return;
    }
      /**
     * Function check whether an a user who is inviting another user is exist in db
     * @since 10-05-2012
     * @author Vishal Vijayan
     * @param <Int> $invited_user
     * @return object
     */
    function isInvitedUserExist($invited_user)
    {
        $sql="SELECT id from user WHERE id = $invited_user";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {            return true;
        }
        else{
            return false;
        }
    }
}