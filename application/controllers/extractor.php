<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
Extractor controller for handling image/video extractor

* @package pinterest clone controller
* @subpackage
* @uses : To handle the other users pages
* @version $id:$
* @since 13-04-2012
* @author Vishal Vijayan
* @copyright Copyright (c) 2007-2010 Cubet Technologies. (http://cubettechnologies.com)
*/
class Extractor extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->library('simple_html_dom.php');
	}
    /**
     * Function to load the extractor page with images extracted from the site. Function not in use from 15/06/2012
     * @param   : 
     * @author  : Vishal
     * @since   : 20-04-2012
     * @return
     */
     public function index()
	 {
       
        //$this->load->library('url_to_absolute.php');
        $result =null;
        if($_GET)
        {
        $source_url         = $_GET['url'];
        $source_scheme      = parse_url($source_url, PHP_URL_SCHEME);
        $html               = file_get_html($source_url);
        $i                  = 0;
        foreach($html->find('img') as $element)
        {

             $pin_url       =  $element->src;
             if(parse_url($pin_url, PHP_URL_SCHEME)=='')
             {
                 $pin_url   = $source_scheme.':'.$pin_url;
             }
             $arr           = @getimagesize($pin_url);
             if($arr)
             {
                list($width, $height, $type, $attr) = getimagesize($pin_url);
                if($width>=100)
                {
                 $result[$i] = array( 'source_url' => $source_url,
                                      'pin_url'    => $pin_url,
                                      'type'      => $arr['mime']
                                );
                }
             }
             $i++;
         }
         $data['result'] = $result;
        }
        else{
            $data['message'] = "Sorry something went wrong!!.Please try again ";
        }
         if(empty ($result))
             $data['no_result']  = true;

         $data['title']  = "Pin your image";
         $this->load->view('extractor_view',$data);
    }
    /**
     * Function to get the image which is to be saved. The new pin page is displayed
     * which the image preview and board selection option.
     * @param   : <string> $pin
     * @param   : <string> $source
     * @author  : Vishal
     * @since   : 23-04-2012
     * @return
     */
    function getSaveImage()
    {
        $this->session->set_userdata('redirect_url',$this->curPageURL());
        $this->sitelogin->entryCheck();
        if($_GET)
        {
            $data['url']            =  $_GET['url'];
            $data['source']         =  $_GET['url1'];
            $data['title']          =  $_GET['title'];
            $data['is_video']       =  $_GET['is_video'];
        }
        else{
            $data['message'] = "Sorry something went wrong!!.Please try again ";
        }
        
        $this->load->view('extractor_view',$data);

    }
    /**
     * Function save the new pin to the pin table
     * board id ,pin url and source url are submitted
     * @param   : 
     * @author  : Vishal
     * @since   : 23-04-2012
     * @return
     */
    function submit()
    {
        $value              = array('user_id'       => $this->session->userdata('login_user_id'),
                                    'pin_url'       => $this->input->post('pin_url'),
                                    'source_url'    => $this->input->post('source_url'),
                                    'board_id'      => $this->input->post('board_id'),
                                    'description'   => $this->input->post('description'),
                                    'type'          => ($this->input->post('is_video')=='true')?'video':'image',
                                    'gift'          => $this->input->post('gift')?$this->input->post('gift'):0
                                            );
        
        //Use the following  code for download and save the new image to the user folder and use it as pin url.
        if($value['type']=='image')
        {   $user_id = $this->session->userdata('login_user_id');
            $url = $value['pin_url'];
            $extn   = explode('.', $url);
            $info   = getimagesize($url);
            $mime   = $info['mime']; // mime-type as string for ex. "image/jpeg" etc.
            $extn = explode('/', $mime);
           
            $image  = time().'_.'.$extn[1];
        
            $dir = getcwd()."/application/assets/pins/$user_id";
            if(file_exists($dir) && is_dir($dir))
            {

            }
            else{

                mkdir(getcwd()."/application/assets/pins/$user_id",0777);
            }
             $img = getcwd()."/application/assets/pins/$user_id/".$image;
             file_put_contents($img, file_get_contents($url));
             $value['pin_url'] = site_url()."application/assets/pins/$user_id/".$image;

        }
         
         

        if(($value['user_id']==0)||(!isset($value['user_id'])))
        {
            redirect('extractor/index');
        }
       
        $id                     = $this->board_model->saveNewPin($value);
        $activity['user_id']    = $this->session->userdata('login_user_id');
        $activity['log']        =  "Added a new ".$value['type'];
        $activity['type']       =  $value['type'];
        $activity['action_id']  =  $id;
        $activity['link']       =  $this->input->post('pin_url');
        activityList($activity);

        $value['title']         = 'Pin it';
        $value['insertId']      = $id;

        /*Post in social networks*/
        //socialNetworkPost($activity,$value);

        $this->load->view('extractor_view',$value);

    }
    /**
     * Function not in use
     * @param   :
     * @author  : Vishal
     * @since   : 20-04-2012
     * @return
     */
    function save()
    {
        $value = array('pin_url'=>$this->input->post('pin_url'),'source_url'=>$this->input->post('pin_url'));
        $id = $this->board_model->saveNewPin($value);
        $this->getSaveImage($array);

    }
    /**
     * Test function not in use.
     */
    function pin()
    {
        // Load the remote document
        $this->load->library('url_to_absolute.php');
        $url = "http://forums.digitalpoint.com/showthread.php?t=1020857";
        $html = file_get_html('http://forums.digitalpoint.com/showthread.php?t=1020857');

        $largest_file_size=0;
        $largest_file_url='';

        // Go through all images of that page
        foreach($html->find('img') as $element){
            // Helper function to make absolute URLs from relative
            $img_url= $this->url_to_absolute->url_to_absolute($url,$element->src);
            //$img_url = $element->src;
            // Try to get image file size info from header:
            $header=array_change_key_case(get_headers($img_url, 1));
            // Only continue if "200 OK" directly or after first redirect:
            if($header[0]=='HTTP/1.1 200 OK' || @$header[1]=='HTTP/1.1 200 OK'){
                if(!empty($header['content-length'])){
                    // If we were redirected, the second entry is the one.
                    // See http://us3.php.net/manual/en/function.filesize.php#84130
                    if(!empty($header['content-length'][1])){
                        $header['content-length']=$header['content-length'][1];
                    }
                    if($header['content-length']>$largest_file_size){
                    $largest_file_size=$header['content-length'];
                    $largest_file_url=$img_url;
                    }
                }else{
                    // If no content-length-header is sent, we need to download the image to check the size
                    $tmp_filename=sha1($img_url);
                    $content = file_get_contents($img_url);
                    $handle = fopen(TMP.$tmp_filename, "w");
                    fwrite($handle, $content);
                    fclose($handle);
                    $filesize=filesize(TMP.$tmp_filename);
                    if($filesize>$largest_file_size){
                    $largest_file_size=$filesize;
                    $largest_file_url=$img_url;
                    unlink(TMP.$tmp_filename);
                    }
                }
            }
        }
        echo $largest_file_url;

    }
     /**
     * Test function not in use.
     */
    function curPageURL() {
         $pageURL = 'http';
         //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
         $pageURL .= "://";
         if ($_SERVER["SERVER_PORT"] != "80") {
          $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
         } else {
          $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
         }
         return $pageURL;
        }
    }

/* End of file extractor.php */
/* Location: ./application/controllers/extractor.php */