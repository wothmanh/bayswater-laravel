<?php
class Notifications_m extends MY_Model
{
	protected $_table_name = 'notifications';
	protected $_order_by = 'id desc';
	public $rules = array(
		'user_id' => array(
			'field' => 'user_id', 
			'label' => 'user id', 
			'rules' => 'trim|max_length[11]'
		),
		'title' => array(
			'field' => 'title', 
			'label' => 'title', 
			'rules' => 'trim|required|max_length[100]'
		),
		'body' => array(
			'field' => 'body', 
			'label' => 'body', 
			'rules' => 'trim|required'
		),
		'time' => array(
			'field' => 'time', 
			'label' => 'time', 
			'rules' => 'trim|max_length[10]'
		),
		'date' => array(
			'field' => 'date', 
			'label' => 'date', 
			'rules' => 'trim|required|max_length[20]'
		),
		'active' => array(
			'field' => 'active', 
			'label' => 'active', 
			'rules' => 'trim|max_length[1]'
		)
		
		
	);

	public function get_new ()
	{
		$slider = new stdClass();
		$slider->user_id = '';
		$slider->title = '';
		$slider->body = '';
		$slider->time = '';
		$slider->date = '';
		$slider->active = '';
		return $slider;
	}


}