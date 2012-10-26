<?php
class Twitter_model extends CI_Model {

	var $accounts_table = 'accounts';
	var $update_url = 'http://twitter.com/statuses/update.xml';

	// get the active twitter account from the database, by row active = 1
	function getActiveAccount()
	{
		return $this->db->get_where($this->accounts_table, array('active' => '1'))->row();
	}

	// update twitter status and last message on success
	function update_status($username, $password, $message)
	{
		$ch = curl_init($this->update_url);

		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'status='.urlencode($message));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);

		curl_exec($ch);

		 $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        print_r(curl_getinfo($ch,CURLINFO_HTTP_CODE));


		// if we were successfull we need to update our last_message
		if ($httpcode == '200')
		{
			$this->db->where('active', '1');
			$this->db->update($this->accounts_table, array('last_message' => $message));

			return TRUE;
		}

		else
		{
			return FALSE;
		}
	}

	// get the last_message, by row active = 1
	function getLastMessage()
	{
		$this->db->select('last_message');
		$last_message =  $this->db->get_where($this->accounts_table, array('active' => '1'))->row()->last_message;

		return htmlspecialchars($last_message);
	}
}
?>