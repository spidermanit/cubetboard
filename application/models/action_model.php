<?php
/**
Action model to handles the actions of a pin. Email, embed , report

* @package pinterest clone model
* @subpackage
* @uses : To handle all the  actions of a pin. Email, embed , report
* @version $id:$
* @since 03-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Action_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    /**
     * Function currently not in use
     * @param  : $followArray
     * @author :
     * @since  : 14-05-2012
     * @return
     */
    function getBoardsFollowed($id=false)
    {
        
    }
    function getBoardFollowers($boardId)
    {
        //$sql = "SELECT count(id) as count FROM follow WHERE is_following_board_id={$boardId}";
        $sql = "SELECT DISTINCT user_id
                    FROM
                        follow
                    WHERE
                        is_following_board_id = $boardId";
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
     * Function save the follows to the db table.
     * @param  : $followArray
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
    function saveFollow($followArray)
    {
        $this->db->insert('follow', $followArray);
       return $this->db->insert_id();
    }
    /**
     * Function check whether a user is following a board or not
     * @since 14-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userId , $boardId
     * @return object
     */
     function isFollow($userId,$boardId)
     {
       $sql ="SELECT 
                    id
                FROM
                    follow
                WHERE
                    user_id = $userId
                AND
                    is_following_board_id =$boardId";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            return true;
        }
        else{
            return false;
        }
    }
    /**
     * Function save the un follows to the db table.
     * @param  : $arrayFollow
     * @author : Vishal
     * @since  : 14-05-2012
     * @return
     */
    function saveUnFollow($arrayFollow)
    {
        $sql ="DELETE
                FROM
                    follow
                WHERE
                    user_id = {$arrayFollow['user_id']}
                AND
                    is_following = {$arrayFollow['is_following']}
                AND
                    is_following_board_id = {$arrayFollow['is_following_board_id']}";
        $query = $this->db->query($sql);
    }
    /**
     * Function to get the number of users that are following a boards
     * @since 14-05-2012
     * @author Vishal Vijayan
     * @param <Int>$boardId
     * @return object
     */
    function countBoardFollowers($boardId)
    {
        //$sql = "SELECT count(id) as count FROM follow WHERE is_following_board_id={$boardId}";
        $sql = "SELECT DISTINCT user_id
                    FROM
                        follow
                    WHERE
                        is_following_board_id = $boardId";
        $query = $this->db->query($sql);
         if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else{
            return 0;
        }
    }
    /**
     * Function get the number of users that are follows the given user
     * @since 14-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userId
     * @return object
     */
    function getUserFollowersCount($userId)
    {
        $sql = "SELECT DISTINCT user_id
                    FROM
                        follow
                    WHERE
                        is_following = $userId";
        $query = $this->db->query($sql);
         if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else{
            return 0;
        }
    }
     /**
     * Function get the number of users that are the given user is following
     * @since 14-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userId
     * @return object
     */
    function getUserFollowingCount($userId)
    {
        $sql = "SELECT DISTINCT
                        is_following
                    FROM
                        follow
                    WHERE
                        user_id = $userId";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {   
            return $query->num_rows();
        }
        else{
            return 0;
        }
    }
    /**
     * Function to follow all the boards of a given user
     * @since 15-05-2012
     * @author Vishal Vijayan
     * @param <Int> $id (user id)
     * @return object
     */
    function followAll($id)
    {
        //get all board of that user
        $boards = getUserBoard($id);
        foreach ($boards as $key => $value) {

            $fetch = "SELECT 
                            id
                        FROM
                            follow
                        WHERE
                            user_id = {$this->session->userdata('login_user_id')}
                        AND
                            is_following = {$value->user_id}
                        AND
                            is_following_board_id = {$value->id}";
            $result=$this->db->query($fetch);
            if($result->num_rows()>0)
            {
            }
            else{
                $sql = "INSERT IGNORE INTO
                                follow(user_id,is_following,is_following_board_id)
                        VALUES({$this->session->userdata('login_user_id')},{$value->user_id},{$value->id})";
                 $query = $this->db->query($sql);
                 $userDetails = userDetails($value->user_id);
                 $activity = array(
                            'user_id'   =>  $this->session->userdata('login_user_id'),
                            'log'       =>  "Following ".$userDetails['name'],
                            'type'      =>  "follow",
                            'action_id' =>  $value->user_id
                );
            }
        }

         activityList($activity);
        
    }
    /**
     * Function check whether we are following all the boads of that given user
     * @since 15-05-2012
     * @author Vishal Vijayan
     * @param <Int> $id (user id)
     * @return object
     */
    function isFollowAll($id)
    {
        $boards = getUserBoard($id);
        $follow = 0;
        foreach ($boards as $key => $value) {

            $fetch = "SELECT
                            id
                        FROM
                            follow
                        WHERE
                            user_id = {$this->session->userdata('login_user_id')}
                        AND
                            is_following = {$value->user_id}
                        AND
                            is_following_board_id = {$value->id}";
            $result=$this->db->query($fetch);
            if($result->num_rows()>0)
            {
                $follow = 1;
            }
            else{
                $follow = 0;

            }

        }
        if($follow==1)
        {
            return true;
        }
         else {
           return false;
        }
    }
    /**
     * Function to un follow all the boards of a given user
     * @since 15-05-2012
     * @author Vishal Vijayan
     * @param <Int> $id (user id)
     * @return object
     */
    function unFollowAll($id)
    {
        //get all board of that user
        $boards = getUserBoard($id);
        foreach ($boards as $key => $value) {

            $fetch = "DELETE 
                        FROM
                            follow
                        WHERE
                            user_id = {$this->session->userdata('login_user_id')}
                        AND
                            is_following = {$value->user_id}
                        AND
                            is_following_board_id = {$value->id}";
            $result=$this->db->query($fetch);
                 $userDetails = userDetails($value->user_id);
                 $activity = array(
                            'user_id'   =>  $this->session->userdata('login_user_id'),
                            'log'       =>  "Un follows ".$userDetails['name'],
                            'type'      =>  "follow",
                            'action_id' =>  $value->user_id
                );

        }
        activityList($activity);


    }
    /**
     * Function to get the Followers (people who are following the user specified)
     * @since 15-05-2012
     * @author Vishal Vijayan
     * @param <Int> $id (user id)
     * @return object
     */
    function getUserFollowers($userId)
    {
        $sql = "SELECT DISTINCT
                        user_id
                    FROM
                        follow
                    WHERE
                        is_following = $userId";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {   
            return $query->result();
        }
        else{
            return 0;
        }
    }
    /**
     * Function to get the Followings (people whom the user provided is following)
     * @since 15-05-2012
     * @author Vishal Vijayan
     * @param <Int> $id (user id)
     * @return object
     */
    function getUserFollowing($userId)
    {
        $sql = "SELECT DISTINCT
                        is_following
                    FROM
                        follow
                    WHERE
                        user_id = $userId";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else{
            return 0;
        }
    }
    /**
     * Function to the activites of a following user (activities of the people that the user mentioned here follows)
     * @since 15-05-2012
     * @author Vishal Vijayan
     * @param <Int> $id (user id)
     * @return object
     */
    function getFollowingsActivity($userId,$limit=false)
    {
        $sql = "SELECT
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
                            follow.user_id = $userId
                   GROUP BY
                            activity.id


                    ORDER BY
                            activity.timestamp DESC
                    ";
        if($limit)
        {
            $sql .= " LIMIT $limit";
        }
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {  
            return $query->result();
        }
        else
            return false;
    }
    /**
     * Function get the pins that are categorized as gifts with in the given price range
     * @since 21-05-2012
     * @author Vishal Vijayan
     * @param $from,$to,$offset,$limit
     * @return object
     */
    function getGiftItems($from,$to,$offset,$limit)
    {   
        $sql   = "SELECT * 
                    FROM
                        pins
                    WHERE
                        gift > {$from} ";

        if($to !='above')
        {
            $sql.=  "AND gift <= {$to}";
        }
        $sql.=" limit $offset , $limit";

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
     * Function get the count of the pins that are categorized as gifts with in the given price range
     * @since 21-05-2012
     * @author Vishal Vijayan
     * @param $from,$to
     * @return object
     */
    function getGiftItemsCount($from,$to)
    {

        $sql   = "SELECT * 
                    FROM
                        pins
                    WHERE
                        gift > {$from} ";
        if($to !='above')
        {
            $sql.=  "AND gift <= {$to}";
        }
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        {
            return $query->num_rows();
        }
        else{
            return 0;
        }
    }
    /**
     * Function search the search items using the search filter (pin/board/user) and seach item.
     * @since    21-05-2012
     * @author  Vishal Vijayan
     * @param   $filter,$searchItem
     * @return  object
     */
    function search($filter,$searchItem)
    {
        switch ($filter) {
             case 'pin':
                $filterTable = 'pins';
                 $sql = "SELECT * 
                            FROM
                                pins
                            WHERE
                                description like '%$searchItem%'";
                 break;
             case 'user':
                $filterTable = 'user';
                 $sql = "SELECT * 
                            FROM
                                user
                            WHERE
                                first_name like '%$searchItem%'";
                 break;
             case 'board':
                $filterTable = 'board';
                  $sql = "SELECT * 
                            FROM
                                board
                            WHERE
                                board_name like '%$searchItem%'";
                 break;
             default:
                  $filterTable = 'pins';
                 break;
          }
         
          $query = $this->db->query($sql);
          if($query->num_rows>0)
          {
              $result = $query->result();
              return $result;
          }
          else{
              return false;
          }
    }
    /**
     * Function to get the most liked pins
     * @since    21-05-2012
     * @author  Vishal Vijayan
     * @param   $filter,$searchItem
     * @return  object
     */
    function getMostLiked()
    {
        $sql = "SELECT
                        pin_id, COUNT( * ) AS count
                FROM
                        likes
                GROUP BY
                        pin_id
                ORDER BY
                        count DESC
                LIMIT 0 , 30";
         $query = $this->db->query($sql);
          if($query->num_rows>0)
          {
              $result = $query->result();
              return $result;
          }
          else{
              return false;
          }
    }
     /**
     * Function to get the most repined pins
     * @since    21-05-2012
     * @author  Vishal Vijayan
     * @param   $filter,$searchItem
     * @return  object
     */
    function getMostRepinned()
    {
        $sql = "SELECT
                        from_pin_id, COUNT( * ) AS count
                FROM
                        repin
                GROUP BY
                        from_pin_id
                ORDER BY
                        count DESC
                LIMIT 0 , 30";
         $query = $this->db->query($sql);
          if($query->num_rows>0)
          {
              $result = $query->result();
              return $result;
          }
          else{
              return false;
          }
        
    }

}