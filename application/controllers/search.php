<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
Search controller to handles the search

* @package pinterest clone controller
* @subpackage
* @uses : To handle the search
* @version $id:$
* @since 21-05-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Search extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}

    /**
     * Function to search the site based on the filter(pins/boards/user) and search item
     * @param  : $filter , $searchItem
     * @author : Vishal
     * @since  : 21-05-2012
     * @return
     */
     public function filter($filter=false,$searchItem=false)
	 {
          $searchItem               = $this->input->post('q')?$this->input->post('q'):$searchItem;
          $searchItem               = str_replace('%20', ' ', $searchItem);
          $filter                   = ($filter)?$filter:'user';
          $data['result']           =  $searchResult  = $this->action_model->search($filter,$searchItem);
          $data['title']            = 'Search';
          $data['filter']           = $filter;
          $data['searchItem']       = $searchItem;
          $this->load->view('header',$data);
          if($filter=='pin')
            $this->load->view('search_pin_view',$data);
          elseif($filter=='user')
              $this->load->view('search_user_view',$data);
          elseif ($filter=='board') {
              $this->load->view('search_board_view',$data);
          }
     }
}
/* End of file search.php */
/* Location: ./application/controllers/search.php */