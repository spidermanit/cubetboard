<?php
/**
Board model to handles the board and its functionalities

* @package pinterest clone model
* @subpackage
* @uses : To handles the board and its functionalities
* @version $id:$
* @since 03-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Board_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    /**
     * Function to a insert board values newly created.
     * @param  : <array> $valueArray
     * @author : Vishal
     * @since  : 26-03-2012
     * @return
     */
    function createBoard($valueArray)
    {
        
       $this->db->insert('board', $valueArray);
       return $this->db->insert_id();
    }
     /**
     * Function to a get the category list.
     * @param  :
     * @author : Vishal
     * @since  : 26-03-2012
     * @return : object array
     */
    function getcategoryList()
    {
        $sql    = "SELECT 
                        *
                    FROM
                        category_list";
        $query  = $this->db->query($sql);
        return $query->result();
    }
    /**
     * Function to a get boards of a user
     * @param  : <int> $id
     * @author : Vishal
     * @since  : 27-03-2012
     * @return : object array
     */
    function getUserBoard($id)
    {
        $sql    = "SELECT 
                        *
                    FROM
                        board
                    WHERE
                        user_id = $id
                    ORDER BY
                        board_position ASC";
        $query  = $this->db->query($sql);
        return $query->result();
    }
    /**
     * Function to a get induvidual board's pin from pin table
     * @param  : <int> $id
     * @author : Vishal
     * @since  : 28-03-2012
     * @return : object array
     */
    function getEachBoardPins($id,$limit=false)
    {
        $sql    = "SELECT 
                        *
                    FROM
                        pins
                    WHERE
                        board_id = $id
                    ORDER BY time DESC";
        if($limit)
            $sql .=" LIMIT 0 ,$limit" ;
        $query  = $this->db->query($sql);
        return $query->result();
    }
    /**
     * Function to a get board details from board id
     * @param  : <int> $boardId
     * @author : Vishal
     * @since  : 28-03-2012
     * @return : row object
     */
    function getBoardDetails($boardId)
    {   
        $sql    = "SELECT
                        *
                    FROM
                        board
                    WHERE
                        id = $boardId";
        $query  = $this->db->query($sql);
        return $query->row();
    }
    /**
     * Function to a insert comments for each pins
     * @param  : <array> $array
     * @author : Vishal
     * @since  : 29-03-2012
     * @return : int id
     */
    function insertPinComments($array)
    {
        $this->db->insert('comments', $array);
        return $this->db->insert_id();
    }
     /**
     * Function to comments of a pin from comments table
     * @param   : <int> $pin_id
     * @$author : Vishal
     * @@since  : 29-03-2012
     * @return  : object array
     */
    function getPinComments($pin_id)
    {
        $sql    = "SELECT
                        *
                    FROM
                        comments
                    WHERE
                        pin_id = $pin_id
                    ORDER BY id asc";
        $query  = $this->db->query($sql);
        return $query->result();
    }
    /**
     * Function to get category name form category field
     * @param  : <string> $field
     * @author : Vishal
     * @since  : 29-03-2012
     * @return : object row
     */
    function getCategoryByField($field)
    {
        $sql    = "SELECT 
                        name
                   FROM
                        category_list
                   WHERE
                        field = '$field'";
        $query  = $this->db->query($sql);
        return $query->row();
    }
    /**
     * Function save the board values after edit
     * @param  : <int> $boardId, <array> $valueArray
     * @author : Vishal
     * @since  : 30-03-2012
     * @return : boolean
     */
    function editSaveBoard($boardId,$valueArray)
    {   $this->db->where('id', $boardId);
        $this->db->update('board', $valueArray);
        return true;
    }
    /**
     * Function delete a board from using its id
     * @param  : <int> $boardId
     * @author : Vishal
     * @since  : 30-03-2012
     * @return : 
     */
    function deleteBoard($boardId)
    {
        /*get pins of that board and delete that pins from all tables*/
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

        $sql = "DELETE
                FROM
                    board
                WHERE
                    id = $boardId";
        $this->db->query($sql);
        /*Delete from other tables also*/
        $this->db->where('is_following_board_id', $boardId);
        $this->db->delete('follow');

        $this->db->where('board_id', $boardId);
       $this->db->delete('report_pins');

        
        
    }
    /**
     * Function get the pin details from pin id
     * @param  : <int> $id, <int> $boardId
     * @author : Vishal
     * @since  : 02-04-2012
     * @return : object row
     */
    function getPinDetails($id,$boardId)
    {
        $sql    = "SELECT 
                        *
                    FROM
                        pins
                    WHERE
                        id = $id";
        if($boardId)
        {
            $sql .=" AND
                        board_id = $boardId";
        }

        $query  = $this->db->query($sql);
        return $query->row();
    }
    /**
     * Function delete a comment of a pin from comment id
     * @param  : $sourceUrl,$random
     * @author : Vishal
     * @since  : 30-03-2012
     * @return : boolean
     */
    function deleteComment($commentId)
    {
        $sql = "DELETE
                FROM
                    comments
                WHERE
                    id = $commentId";
        $this->db->query($sql);
    }
    /**
     * Function save the details for a reported pin
     * @param  : $reportArray
     * @author : Vishal
     * @since  : 19-04-2012
     * @return : int
     */
    function reportPin($reportArray)
    {
        $this->db->insert('report_pins', $reportArray);
        return $this->db->insert_id();
    }
    /**
     * Function to a get pins from pin tables with same source.random parameter is used for
     * feteching random pins and for display all pins of same source the random parameter is not used.
     * @param  : $sourceUrl,$random
     * @author : Vishal
     * @since  : 28-03-2012
     * @return : object array
     */
    function getPinsBySource($sourceUrl,$random)
    {
        $sql = "SELECT
                    *
                FROM
                    pins";
        if($sourceUrl)
        {
            $sql.=" WHERE
                    source_url like '%$sourceUrl%'";
        }
        else{
            $sql.=" WHERE
                    source_url ='' ";
        }

                
        if($random)
        {
          $sql .=" ORDER BY
                        RAND()
                   LIMIT 3";
        }
       
        $query = $this->db->query($sql);
        return $query->result();

    }

     /**
     * Function save the editted pin details back to pins table
     *
     * @since 10-04-2012
     * @param  $pinId,$pinArray
     * @return boolean
     * @author vishal vijayan
     */
    function saveEditPin($pinId,$pinArray)
    {
        $this->db->where('id', $pinId);
        $this->db->update('pins', $pinArray);
        return true;
    }
    /**
     * Function to delete a pin based on pin id and board id
     * also delete the comments of that pin from comments table
     * @param  : $pinId,$boardId
     * @author : Vishal
     * @since  : 10-04-2012
     * @return :
     */
    function deletePin($pinId,$boardId)
    {

        $this->db->where('new_pin_id', $pinId);
        $this->db->delete('repin');

        $this->db->where('from_pin_id', $pinId);
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
        
        $sql = "DELETE
                    FROM
                        pins
                    WHERE
                        id = $pinId
                    AND
                        board_id = $boardId";
        $this->db->query($sql);



    }
    /**
     * Function to save the likes to likes table
     *
     * @param  : <array> $likes
     * @author : Vishal
     * @since  : 16-01-2012
     * @return : <int>
     */
    function saveLikes($likes)
    {
        $this->db->insert('likes', $likes);
        return $this->db->insert_id();
    }
    /**
     * Function to get the count of likes of all pins of a user
     * @since 12-04-2012
     * @author Vishal Vijayan
     * @param <int> $userid;
     * @return <type>object
     */
    function pinLikes($userid)
    {
         $sql        = "SELECT
                            count(pin_id) as count
                        FROM
                            likes
                        WHERE
                            like_user_id = $userid";
        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->row();
            return $row->count;
        }
        else{
            return 0;
        }
    }
    /**
     * Function to save the new pin to the pin table
     * @since 12-04-2012
     * @author Vishal Vijayan
     * @param <array> $value;
     * @return <int> id
     */
    function saveNewPin($value)
    {
        $this->db->insert('pins', $value);
        return $this->db->insert_id();
    }
    /**
     * Function to all pins from the pin table, may or may not user id provided
     * @since 03-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userID;
     * @return <int> id
     */
    function getAllPins($userID=false,$order=false)
    {
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
            $sql .= " ORDER BY time DESC";
        }
        //$sql .= " LIMIT 0,5";
        
        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->result();
            return $row;
        }
    }
    function getAllPinsAjax($offset,$limit)
    {  $userID =false;

        $order = false;
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
            $sql .= " ORDER BY time DESC";
        }
        $sql .= " LIMIT $offset,$limit";

        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->result();

        }
        return $row;
    }
    /**
     * Function to save activity list to activity table
     * @since 03-05-2012
     * @author Vishal Vijayan
     * @param <array> $current;
     * @return <int> id
     */
    function saveActivity($current)
    {
        $this->db->insert('activity', $current);
        return $this->db->insert_id();
    }
    /**
     * Function to get the recent activites may or may not user id provided
     * @since 03-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userID;
     * @return <int> id
     */
    function getActivity($userID=false)
    {
        $sql = "SELECT * 
                    FROM
                        activity";

        if($userID)
            $sql .= " WHERE 
                        user_id = $userID ";

         $sql .= " ORDER BY
                        timestamp DESC ";
        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->result();
            return $row;
        }
    }
    /**
     * Function to get the count of activites done by a user
     * @since 03-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userId;
     * @return object
     */
    function activityCount($userId)
    {
        $sql = "SELECT 
                    count(id) AS count
                FROM
                    activity ";

        if($userId)
            $sql .= " WHERE 
                        user_id = $userId ";
        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->row();
            return $row->count;
        }
    }
    function getPinsLike($userId=false)
    {
        $sql = "SELECT * 
                    FROM likes";

        if($userId)
            $sql .= " WHERE 
                        like_user_id = $userId ";

         //$sql .= " ORDER BY timestamp DESC ";
        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->result();
            return $row;
        }
    }
    /**
     * Function to check whether a  pin is liked by a user?
     * @since 03-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userId;
     * @param <Int> $pinId;
     * @return object
     */
    function isLiked($pinId,$userId)
    {
        $sql ="SELECT * 
                    FROM
                        likes
                    WHERE
                        pin_id = $pinId
                    AND
                        like_user_id = $userId";
        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->result();
            return true;
        }
        else{
            return false;
        }
    }
    /**
     * Function to get the count of likes of a pin
     * @since 07-05-2012
     * @author Vishal Vijayan
     * @param <Int> $pinId;
     * @return object
     */
    function getPinLikeCount($pin_id)
    {
        $sql        = "SELECT
                            count(pin_id) as count
                        FROM
                            likes
                        WHERE
                            pin_id = $pin_id";
        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->row();
            return $row->count;
        }
        else{
            return 0;
        }
    }
    /**
     * Function to unlike a pin / delete the pin like
     * @since 07-05-2012
     * @author Vishal Vijayan
     * @param <array> $like;
     * @return object
     */
    function unLikes($like)
    {
        $this->db->where('pin_id', $like['pin_id']);
        $this->db->where('like_user_id', $like['like_user_id']);
        $this->db->where('source_user_id', $like['source_user_id']);
        $this->db->delete('likes');
    }
    /**
     * Function to save the repin details of a pin
     * @since 10-05-2012
     * @author Vishal Vijayan
     * @param <array> $repin;
     * @return object
     */
    function saveRepin($repin)
    {
        $this->db->insert('repin', $repin);
        return $this->db->insert_id();
    }
    /**
     * Function to get the count of repins from a given pin
     * @since 10-05-2012
     * @author Vishal Vijayan
     * @param <Int> $searchValue;
     * @param <String> $searchName;
     * @return object
     */
    function getRepinCount($searchValue=false,$searchName=false)
    {
         $sql        = "SELECT
                            count(id) as count
                        FROM
                            repin
                        WHERE
                            $searchValue = '$searchName'";
        $query      = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            $row    = $query->row();
            return $row->count;
        }
        else{
            return 0;
        }
    }
    /**
     * Function test. Not in use

     */
    function test()
    {
        echo $sql = "SELECT
                            activity.id                     as activity_id,
                            activity.user_id                as activity_user,
                            activity.log                    as activity_log,
                            activity.type                   as activity_type,
                            activity.action_id              as activity_action_id,
                            activity.link                   as activity_link,
                            activity.timestamp              as activity_timestamp,

                            follow.user_id                  as follow_user_id,
                            follow.is_following             as follow_is_following,
                            follow.is_following_board_id    as follow_is_following_board_id
                            
                    FROM
                            activity 
                    JOIN
                            follow 
                    ON
                            follow.is_following = activity.user_id
                    
                    WHERE
                            follow.user_id = 25

                    GROUP BY
                            activity.id
                            
                    ORDER BY
                            activity.timestamp DESC
                    ";
        $query = $this->db->query($sql);
        

    }
    /**
     * Function to rearrange the boards and save the positions
     * @since  10-05-2012
     * @author Vishal Vijayan
     * @param  $array;
     * @return
     */
    function rearrangeBoard($array)
    {
        foreach ($array as $key => $value) {
            $this->db->set('board_position', $key);
            $this->db->where('id', $value);
            $this->db->update('board');
        }
    }
    /**
     * Function to a get pins from pin tables with same type.random parameter is used for
     * feteching random pins and for display all pins of same type the random parameter is not used.
     * @param  : $sourceUrl,$random
     * @author : Vishal
     * @since  : 17-05-2012
     * @return : object array
     */
    function getPinsByType($type,$random=false)
    {
        $sql = "SELECT
                    *
                FROM
                    pins
                WHERE
                    type = '$type'";
        if($random)
        {
          $sql .=" ORDER BY
                        RAND()
                   LIMIT 3";
        }
        $query = $this->db->query($sql);
        return $query->result();

    }
    /**
     * Function to save the uploaded pin
     * @since  10-05-2012
     * @author Vishal Vijayan
     * @param  $insert;
     * @return
     */
    function saveUploadPin($insert)
    {
        $this->db->insert('pins', $insert);
        return $this->db->insert_id();
    }
    /**
     * Function to user details by id
     * @since  10-05-2012
     * @author Vishal Vijayan
     * @param  $userId;
     * @return
     */
    function getUserDetailsById($userId)
    {
        $sql = "SELECT *
                    FROM
                        user
                    WHERE
                        id = $userId";
        $query = $this->db->query($sql);
        return $query->row();
    }
    /**
     * Function to get repin users of a pin
     * @since  10-05-2012
     * @author Vishal Vijayan
     * @param  $pin_id,$limit;
     * @return
     */
    function getRepinUsers($pin_id,$limit=false)
    {
        $sql = "SELECT *
                    FROM
                        repin
                    WHERE
                        from_pin_id = $pin_id";
        if($limit)
        {
            $sql .=" LIMIT 0 ,$limit" ;
        }
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
     * Function to get like users of a pin
     * @since  10-05-2012
     * @author Vishal Vijayan
     * @param  $pin_id,$limit;
     * @return
     */
    function getLikeUsers($pin_id,$limit=false)
    {
        $sql = "SELECT *
                    FROM
                        likes
                    WHERE
                        pin_id = $pin_id";
        if($limit)
        {
            $sql .=" LIMIT 0 ,$limit" ;
        }
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
     * Function to get highest board position
     * @param  :
     * @author : Vishal
     * @since  : 28-05-2012
     * @return
     */
    function highestBoard($userId)
    {
        $sql = "SELECT max( board_position ) as position
                FROM board
                WHERE user_id =$userId";

        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {  $row = $query->row();
            return $row->position;
        }
        else{
            return 0;
        }
    }

}