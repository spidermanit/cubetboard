<?php
class MyConfigClass {
    function MyConfigfunction() {
        
        $CI =& get_instance();
        $row = $CI->db->get_where('config', array('id' => 1))->row();
        //print_r($row);
        $ci->load->config();

        //$CI->config->set_item('base_url', 'http://test.com');
        //$CI->config->set_item('tweet_consumer_key', 'sVCCZbM9gspM7pk6sKhqQ');
        $CI->config->set_item('check_value', '456');
        //$config['tweet_consumer_key'] = 'sVCCZbM9gspM7pk6sKhqQ';
    }
}
