<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * pinterest helper
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
    /**
     * Function to select a needed profile detail of a user
     * @param  : <int> $referenceID,<string> $reference
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function getPrimaryID($referenceID,$reference)
    {
        $CI             = & get_instance();
        $CI->load->model('editprofile_model');
        $result         = $CI->editprofile_model->getPrimaryID($referenceID,$reference);
        return $result;
    }
    /**
     * Function to select a needed profile detail of a user
     * @param  : <int> $referenceID,<string> $reference ,<string> $neededValue
     * @author : Vishal
     * @since  : 20-03-2012
     * @return
     */
    function getUserDetails($referenceID,$reference,$neededValue)
    {
        $CI         = & get_instance();
        $CI->load->model('editprofile_model');
        $result     = $CI->editprofile_model->getUserDetails($referenceID,$reference,$neededValue);
        return $result;
    }
    /**
     * Function to a get the category list.
     * @param  :
     * @author : Vishal
     * @since  : 26-03-2012
     * @return
     */
    function getCategoryList()
    {
        $CI         = & get_instance();
        $CI->load->model('board_model');
        $result     = $CI->board_model->getcategoryList();
        return $result;
    }
     /**
     * Function to a get boards of a user
     * @param  :
     * @author : Vishal
     * @since  : 27-03-2012
     * @return
     */
    function getUserBoard($id)
    {
        $CI         = & get_instance();
        $CI->load->model('board_model');
        $result     = $CI->board_model->getUserBoard($id);
        return $result;
    }
    /**
     * Function to a get board details from board id
     * @param  :
     * @author : Vishal
     * @since  : 28-03-2012
     * @return
     */
    function getBoardDetails($boardId)
    {
        $CI         = & get_instance();
        $CI->load->model('board_model');
        $result     = $CI->board_model->getBoardDetails($boardId);
        return $result;
    }
    /**
     * Function to a get induvidual board's pin from pin table
     * @param  :
     * @author : Vishal
     * @since  : 28-03-2012
     * @return
     */
    function getEachBoardPins($id,$limit=false)
    {
        $CI         = & get_instance();
        $CI->load->model('board_model');
        $result     = $CI->board_model->getEachBoardPins($id,$limit);
        return $result;
    }
    /**
     * Function to a get the comments for each pin from comment table using  pin_id
     * @param  :
     * @author : Vishal
     * @since  : 28-03-2012
     * @return
     */
    function getPinComments($pin_id)
    {
        $CI         = & get_instance();
        $CI->load->model('board_model');
        $result     = $CI->board_model->getPinComments($pin_id);
        return $result;
    }
    /**
     * Function to a get the category name by category field
     * @param  :
     * @author : Vishal
     * @since  : 28-03-2012
     * @return
     */
    function getCategoryByField($field)
    {
        $CI         = & get_instance();
        $CI->load->model('board_model');
        $result     = $CI->board_model->getCategoryByField($field);
        return $result;
    }
    /**
     * Function to a get the details of a pin from its pin id
     * @param  :
     * @author : Vishal
     * @since  : 28-03-2012
     * @return
     */
    function getPinDetails($id,$boardId=false)
    {
        $CI         = & get_instance();
        $CI->load->model('board_model');
        $result     = $CI->board_model->getPinDetails($id,$boardId);
        return $result;
    }
    /**
     * Function to a get the domain name from a url
     * @param  :
     * @author : Vishal
     * @since  : 10-04-2012
     * @return
     */
    function GetDomain($url)
    {
//        $nowww      = ereg_replace('www\.','',$url);
        $nowww      = preg_replace('/www\./','',$url);
        $domain     = parse_url($nowww);
        if(!empty($domain["host"]))
        {
            return $domain["host"];
        }
        else
        {
           return $domain["path"];
        }

    }
    /**
     * Function to a get pins from pin tables with same source.random parameter is used for
     * feteching random pins and for display all pins of same source the random parameter is not used.
     * @param  :
     * @author : Vishal
     * @since  : 28-03-2012
     * @return
     */
    function getPinsBySource($sourceUrl,$random=false)
    {
        $CI         = & get_instance();
        $CI->load->model('board_model');
        $result     = $CI->board_model->getPinsBySource($sourceUrl,$random);
        return $result;
    }
    /**
     * Function to handle the logged user details
     * @since 12-04-2012
     * @author Vishal Vijayan
     * @param
     * @return <type> array
     */
    function userDetails($id=false)
    {       
        $CI             = & get_instance();
        $userDetails    = $CI->sitelogin->userDetails($id);
        return $userDetails;
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
        $CI         = & get_instance();
        $CI->load->model('board_model');
        $result     = $CI->board_model->pinLikes($userid);
        return $result;

    }
    /**
     * Function to get all pins irrespective of users
     * @since 30-04-2012
     * @author Vishal Vijayan
     * @param <int> $userid;
     * @return <type>object
     */
    function getAllPins($userID=false,$order=false)
    {
        $CI         = & get_instance();
        $CI->load->model('board_model');
        $result     = $CI->board_model->getAllPins($userID,$order);
        return $result;
    }
    /**
     * Function will accept the activity array and save it to db
     * @since 02-05-2012
     * @author Vishal Vijayan
     * @param <array> $activity;
     * @return
     */
    function activityList($activity=false)
    {   $CI     = & get_instance();
        if(is_array($CI->session->userdata('activitylist')))
        {  
            if(is_array($activity))
            {   
                //echo $index = max(array_keys(($CI->session->userdata('activitylist')))) + 1;
                //$current = $CI->session->userdata('activitylist');
                //$current[$index] = $activity;
                //$CI->session->unset_userdata('activitylist');
                //$CI->session->set_userdata('activitylist',$current);
                $CI->board_model->saveActivity($activity);
                
            }
        }
        else{
            if(!$CI->session->userdata('activitylist'))
            {
                if(is_array($activity))
                {
                    //$acti[0] = $activity;
                    //$CI->session->set_userdata('activitylist',$acti);
                    $CI->board_model->saveActivity($activity);
                }
            }
        }
        return $CI->session->userdata('activitylist');
        
    }
    /**
     * Function to get the activites, may or may not user specific
     * @since 02-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userID;
     * @return
     */
    function getActivity($userID=false)
    {
        $CI     = & get_instance();
        $CI->load->model('board_model');
        $result = $CI->board_model->getActivity($userID);
        return $result;
    }
    /**
     * Function to get the count of activites done by a user
     * @since 03-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userId;
     * @return object
     */
     function activityCount($userId=false)
     {
        $CI     = & get_instance();
        $CI->load->model('board_model');
        $result = $CI->board_model->activityCount($userId);
        return $result;
     }
     /**
     * Function to pins that are liked by a user
     * @since 03-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userId;
     * @return object
     */
     function getPinsLike($userId=false)
     {
        $CI     = & get_instance();
        $CI->load->model('board_model');
        $result = $CI->board_model->getPinsLike($userId);
        return $result;
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
        $CI     = & get_instance();
        $CI->load->model('board_model');
        $result = $CI->board_model->isLiked($pinId,$userId);
        return $result;
     }
     /**
     * Function to get the count of likes of a pin
     * @since 07-05-2012
     * @author Vishal Vijayan
     * @param <Int> $pinId;
     * @return object
     */
     function getPinLikeCount($pinId)
     {
        $CI     = & get_instance();
        $CI->load->model('board_model');
        $result = $CI->board_model->getPinLikeCount($pinId);
        return $result;
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
        $CI     = & get_instance();
        $CI->load->model('board_model');
        $result = $CI->board_model->getRepinCount($searchValue,$searchName);
        return $result;
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
        $CI     = & get_instance();
        $CI->load->model('login_model');
        $result = $CI->login_model->isInvitedUserExist($invited_user);
        return $result;
     }
     /**
     * Function check whether a user is following a board or not
     * @since 14-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userId , $boardId
     * @return object
     */
     function isFollow($userId=false,$boardId=false)
     {
        $CI     = & get_instance();
        $CI->load->model('action_model');
        $result = $CI->action_model->isFollow($userId,$boardId);
        return $result;
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
        $CI     = & get_instance();
        $CI->load->model('action_model');
        $result = $CI->action_model->countBoardFollowers($boardId);
        return $result;
     }
     function getBoardFollowers($boardId)
     {
        $CI     = & get_instance();
        $CI->load->model('action_model');
        $result = $CI->action_model->getBoardFollowers($boardId);
        return $result;
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
        $CI     = & get_instance();
        $CI->load->model('action_model');
        $result = $CI->action_model->getUserFollowersCount($userId);
        return $result;
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
        $CI     = & get_instance();
        $CI->load->model('action_model');
        $result = $CI->action_model->getUserFollowingCount($userId);
        return $result;
     }
      /**
     * Function check whether we are following all the boads of that given user
     * @since 15-05-2012
     * @author Vishal Vijayan
     * @param <Int> $userId (user id)
     * @return object
     */
     function isFollowAll($userId)
     {
        $CI     = & get_instance();
        $CI->load->model('action_model');
        $result = $CI->action_model->isFollowAll($userId);
        return $result;
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
         $CI     = & get_instance();
        $CI->load->model('action_model');
        $result = $CI->action_model->getUserFollowers($userId);
        return $result;
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
        $CI     = & get_instance();
        $CI->load->model('action_model');
        $result = $CI->action_model->getUserFollowing($userId);
        return $result;
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
        $CI     = & get_instance();
        $CI->load->model('action_model');
        $result = $CI->action_model->getFollowingsActivity($userId,$limit);
        return $result;
    }
    /**
     * Function to a get pins from pin tables with same type.random parameter is used for
     * feteching random pins and for display all pins of same type the random parameter is not used.
     * @param  :
     * @author : Vishal
     * @since  : 28-03-2012
     * @return
     */
    function getPinsByType($type,$random=false)
    {
        $CI     = & get_instance();
        $CI->load->model('board_model');
        $result = $CI->board_model->getPinsByType($type,$random);
        return $result;
    }
    /**
     * Function to a get user details from user id
     * @param  : $userId
     * @author : Vishal
     * @since  : 28-03-2012
     * @return
     */
    function getUserDetailsById($userId)
    {
        $CI     = & get_instance();
        $CI->load->model('board_model');
        $result = $CI->board_model->getUserDetailsById($userId);
        return $result;
    }
    /**
     * Function post updates to social network
     * @param  : $activity,$value
     * @author : Vishal
     * @since  : 28-03-2012
     * @return
     */
    function socialNetworkPost($activity,$value)
    {

        $CI     = & get_instance();
        $userId = $CI->session->userdata('login_user_id');
        $result = $CI->board_model->getUserDetailsById($userId);
        if(($result->connect_by=='facebook')&&($result->facebook_post==1))
        {
            $config = array(
						'appId'  => $CI->config->item('facebook_app_id'),
						'secret' => $CI->config->item('facebook_app_secret'),
						'fileUpload' => true, // Indicates if the CURL based @ syntax for file uploads is enabled.
						);
            $CI->load->library('Facebook', $config);
            $CI->load->model('Facebook_model');
            $access_token = $CI->facebook->getAccessToken();
            $fb_data    = $CI->session->userdata('fb_data');
            $wall_post = array(
                    //'access_token' => $access_token,
                    'message' => 'Cubetboard',
                    'name' => $activity['log']    ,
                    'caption' => $value['description'] ,
                    'link' => site_url('board/pins/'.$value['board_id'].'/'.$value['insertId']),
                    'picture' => $value['pin_url']
                    );
            $CI->facebook->api('/me/feed/', 'post', $wall_post);
        }
        if(($result->connect_by=='twitter')&&($result->twitter_post==1))
        {
            $CI->load->library('twitter');
            $CI->load->library('tank_auth');
            $CI->tweet->enable_debug(TRUE);
            $link = site_url('board/pins/'.$value['board_id'].'/'.$value['insertId']);
            $update = $activity['log'].'-'.$value['description'].'- '.$link;
            $result = $CI->tweet->call('post', 'statuses/update', array('status' => $update));
        }
        
    
        
    }
    /**
     * Function to get the most liked pins
     * @param  :
     * @author : Vishal
     * @since  : 28-05-2012
     * @return
     */
    function getMostLiked()
    {
        $CI     = & get_instance();
        $CI->load->model('action_model');
        $result = $CI->action_model->getMostLiked();
        return $result;
    }
    /**
     * Function to get the most repined pins
     * @param  :
     * @author : Vishal
     * @since  : 28-05-2012
     * @return
     */
    function getMostRepinned()
    {
        $CI     = & get_instance();
        $CI->load->model('action_model');
        $result = $CI->action_model->getMostRepinned();
        return $result;
    }
    /**
     * Function to get the user who  repined a particular pin
     * @param  :
     * @author : Vishal
     * @since  : 28-05-2012
     * @return
     */
    function getRepinUsers($pin_id,$limit=false)
    {
        $CI     = & get_instance();
        $CI->load->model('board_model');
        $result = $CI->board_model->getRepinUsers($pin_id,$limit);
        return $result;
    }
    /**
     * Function to get users who liked a particular pin
     * @param  :
     * @author : Vishal
     * @since  : 28-05-2012
     * @return
     */
    function getLikeUsers($pin_id,$limit=false)
    {
        $CI     = & get_instance();
        $CI->load->model('board_model');
        $result = $CI->board_model->getLikeUsers($pin_id,$limit);
        return $result;
    }
    /**
     * Function to get highest board position
     * @param  :
     * @author : Vishal
     * @since  : 28-05-2012
     * @return
     */
    function  highestBoard($userId)
    {
        $CI     = & get_instance();
        $CI->load->model('board_model');
        $result = $CI->board_model->highestBoard($userId);
        return $result;
    }
/* End of file pinterest_helper.php */
/* Location: ./application/helpers/pinterest_helper.php */