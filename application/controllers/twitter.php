<?php
/*Controller not in use*/

class Twitter extends CI_Controller {


    function __construct()
	{
		parent::__construct();
        $this->load->model('twitter_model');
	}

	function index()
	{
		$data['heading'] = 'Hi, send a tweet!';
		$data['last_message'] = $this->twitter_model->getLastMessage();
		$data['active_user'] = $this->twitter_model->getActiveAccount()->username;

		$this->load->view('/twitter/twitter_view', $data);
		//$this->load->view('/twitter/index');
		//$this->load->view('/twitter/footer');
	}

	// updating our status on twitter ( new message )
	function update()
	{
		if ($this->input->post('submit'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('
<div class="error">', '</div>

');
			$this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[5]|max_length[140]');

			if ($this->form_validation->run() == FALSE)
			{
				$this->index();
			}

			else
			{
				//$message = $this->input->post('message');

				// get useraccount data
				$account = $this->twitter_model->getActiveAccount();
				$username = $account->username;
				$password = $account->password;

				// send a tweet
				if ($this->twitter_model->update_status($username, $password, $message))
				{
					redirect('twitter');
				}

				else
				{
					$data['error'] = 'There was an error while updating your status';

					$this->load->view('/twitter/twitter_view', $data);
					//$this->load->view('/twitter/error');
					//$this->load->view('/twitter/footer');
				}
			}
		}

		else
		{
			redirect('twitter');
		}
	}
    function twitterPost()
    {
               $message = 'hai test';

				// get useraccount data
				$account = $this->twitter_model->getActiveAccount();
				 $username = $account->username;
				 $password = $account->password;

				// send a tweet
				if ($this->twitter_model->update_status($username, $password, $message))
				{
					//redirect('twitter');
                    echo "success";
				}

				else
				{
					echo 'There was an error while updating your status';

					//$this->load->view('/twitter/twitter_view', $data);
					//$this->load->view('/twitter/error');
					//$this->load->view('/twitter/footer');
				}
    }
}
?>