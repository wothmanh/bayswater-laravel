<?php
class MY_Controller extends CI_Controller {
	
	public $data = array();
		function __construct() {
			parent::__construct();
			$this->data['errors'] = array();
			$this->data['site_name'] = config_item('site_name');
		}
}

class Frontend_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();
		
		//$this->load->model('site_m');
		
		$this->data['meta_title'] = config_item('site_name');
	}
}

class Admin_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();

		$this->data['meta_title'] = config_item('site_name');

		$this->load->helper('form');

		$this->load->library('form_validation');
		$this->load->library('session');
		
		$this->load->model('user_m');
		$this->load->model('settings_m');
		$this->load->model('users_groups_m');
		$this->load->model('clients_m');
		$this->load->model('notifications_m');

		$this->load->model('branches_m');
		$this->load->model('currency_m');
		$this->load->model('notes_m');
		$this->load->model('payments_m');
		$this->load->model('regions_m');
		$this->load->model('countries_m');
		$this->load->model('cities_m');
		$this->load->model('courses_m');
		$this->load->model('schools_m');
		$this->load->model('prices_m');
		$this->load->model('acco_prices_m');
		$this->load->model('airports_m');
		$this->load->model('accommodation_m');
		$this->load->model('accomo_discount_m');
		$this->load->model('course_discount_m');
		$this->load->model('fixed_discount_m');
		$this->load->model('other_discount_m');

		$this->load->model('courses_addons_m');
		$this->load->model('courses_family_m');
		$this->load->model('courses_exam_m');
		$this->load->model('courses_exam_prices_m');
		$this->load->model('courses_professional_m');
		$this->load->model('courses_premium_m');
		$this->load->model('courses_premium_prices_m');

		$this->data['settings'] = $this->settings_m->get(1);
		$this->data['user_group'] = $this->users_groups_m->get_where(array('id' => $this->session->userdata('grpid')), $this->session->userdata('grpid'), true);

		//Asia/Riyadh
		date_default_timezone_set("Africa/Casablanca");

        $checkdt =  date("Y-m-d").' '.date("H:i");
	    $erwhere = array('at <=' => $checkdt, 'onoff' => 0, 'made_by' => $this->session->userdata('id'));
	    //$erwhere = array();

	    $this->data['mynotesnum'] = $this->clients_m->count_this('notes',$erwhere);

		// Login check
		$exception_uris = array(
			'user/login', 
			'user/logout'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->user_m->loggedin() == FALSE) {
				redirect('user/login');
			}
		}
	
	}
}


