<?php
class Users_groups_m extends MY_Model
{
	protected $_table_name = 'users_groups';
	protected $_order_by = 'id desc';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Name', 
			'rules' => 'trim|required|max_length[50]'
		),
		'description' => array(
			'field' => 'description', 
			'label' => 'description', 
			'rules' => 'trim'
		),
		'settings' => array(
			'field' => 'settings', 
			'label' => 'settings ', 
			'rules' => 'trim|required|max_length[1]'
		),
		'schools' => array(
			'field' => 'schools', 
			'label' => 'schools', 
			'rules' => 'trim|required|max_length[1]'
		), 
		'airports' => array(
			'field' => 'airports', 
			'label' => 'airports ', 
			'rules' => 'trim|max_length[1]'
		), 
		'courses' => array(
			'field' => 'courses', 
			'label' => 'courses', 
			'rules' => 'trim|max_length[1]'
		), 
		'accommodation' => array(
			'field' => 'accommodation', 
			'label' => 'accommodation', 
			'rules' => 'trim|max_length[1]'
		), 
		'admins' => array(
			'field' => 'admins', 
			'label' => 'admins', 
			'rules' => 'trim|max_length[1]'
		), 
		'users_groups' => array(
			'field' => 'users groups', 
			'label' => 'users groups', 
			'rules' => 'trim|max_length[1]'
		), 
		'countries' => array(
			'field' => 'countries', 
			'label' => 'countries', 
			'rules' => 'trim|max_length[1]'
		), 
		'cities' => array(
			'field' => 'cities', 
			'label' => 'cities', 
			'rules' => 'trim|max_length[1]'
		), 
		'clients' => array(
			'field' => 'clients', 
			'label' => 'clients', 
			'rules' => 'trim|max_length[1]'
		), 
		'currency' => array(
			'field' => 'currency', 
			'label' => 'currency', 
			'rules' => 'trim|max_length[1]'
		), 
		'branches' => array(
			'field' => 'branches', 
			'label' => 'branches', 
			'rules' => 'trim|max_length[1]'
		), 
		'active' => array(
			'field' => 'active', 
			'label' => 'active', 
			'rules' => 'trim|max_length[1]'
		)
	);

	public function get_new ()
	{
		$channel = new stdClass();
		$channel->name = '';
		$channel->description = '';
		$channel->settings = '';
		$channel->schools = '';
		$channel->airports = '';
		$channel->courses = '';
		$channel->accommodation = '';
		$channel->admins = '';
		$channel->users_groups = '';
		$channel->countries = '';
		$channel->cities = '';
		$channel->clients = '';
		$channel->currency = '';
		$channel->branches = '';
		$channel->active = '';
		return $channel;
	}


}