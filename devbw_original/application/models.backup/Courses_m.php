<?php
class Courses_m extends MY_Model
{
	protected $_table_name = 'courses';
	protected $_order_by = 'id asc';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'name', 
			'rules' => 'trim|max_length[100]'
		),
		'active' => array(
			'field' => 'active', 
			'label' => 'active', 
			'rules' => 'trim|max_length[1]'
		),
		'school_id' => array(
			'field' => 'school_id', 
			'label' => 'school', 
			'rules' => 'trim|max_length[11]|required'
		),
		'type' => array(
			'field' => 'type', 
			'label' => 'type', 
			'rules' => 'trim|max_length[1]'
		),'start' => array(
			'field' => 'start', 
			'label' => 'start', 
			'rules' => 'trim'
		)	
		
	);

	public function get_new ()
	{
		$slider = new stdClass();
		$slider->name = '';
		$slider->active = '';
		$slider->type = '';
		$slider->start = '';
		$slider->school_id = '';
		return $slider;
	}


}