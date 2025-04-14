<?php
class User_M extends MY_Model
{
	
	protected $_table_name = 'users';
	protected $_order_by = 'name';
	public $rules = array(
		'username' => array(
			'field' => 'username', 
			'label' => 'Username', 
			'rules' => 'trim|required'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required'
		)
	);
		public $rules_admin = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Name', 
			'rules' => 'trim|required'
		),
		'users_groups' => array(
			'field' => 'users_groups', 
			'label' => 'User groups', 
			'rules' => 'trim|required'
		),
		'img' => array(
			'field' => 'img', 
			'label' => 'Picture', 
			'rules' => 'trim'
		), 
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|required|valid_email'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|matches[password_confirm]'
		),
		'password_confirm' => array(
			'field' => 'password_confirm', 
			'label' => 'Confirm password', 
			'rules' => 'trim|matches[password]'
		),
		'branch' => array(
			'field' => 'branch', 
			'label' => 'branch', 
			'rules' => 'trim|max_length[5]'
		),
		'admin' => array(
			'field' => 'admin', 
			'label' => 'admin type', 
			'rules' => 'trim|max_length[1]'
		)
	);

	function __construct ()
	{
		parent::__construct();
	}

	public function login ()
	{
	    


		$user = $this->get_by(array(
			'name' => $this->input->post('username'),
			'password' => $this->hash($this->input->post('password')),
		), TRUE);
		
		
// 		echo $this->input->post('username')."<br>";
// 		echo $this->hash($this->input->post('password'))."<br>";
		
		
// 		echo "<pre>";
// 		print_r($user);
		
		
		if (!is_null($user)) {
			// Log in user
			$data = array(
				'name' => $user->name,
				'img' => $user->img,
				'id' => $user->id,
				'grpid' => $user->users_groups,
				'admin' => $user->admin,
				'branch' => $user->branch,
				'loggedin' => TRUE,
			);
			$this->session->set_userdata($data);
			return TRUE;
// 			return "YES";
		}
// 		else
// 		return "NO";
	}

	public function logout ()
	{
		$this->session->sess_destroy();
	}

	public function loggedin ()
	{
		return (bool) $this->session->userdata('loggedin');
	}
	
	public function get_new(){
		$user = new stdClass();
		$user->users_groups = '';
		$user->branch = '';
		$user->admin = '';
		$user->name = '';
		$user->email = '';
		$user->img = '';
		$user->password = '';
		return $user;
	}

	public function hash ($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}
}