<?php
class Courses_Professional_m extends MY_Model
{
	
	protected $_table_name = 'courses_professional';
	protected $_order_by = 'id asc';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'name', 
			'rules' => 'trim|max_length[100]'
		),
		'duration' => array(
			'field' => 'duration',
			'label' => 'duration',
			'rules' => 'trim|required|integer|min_length[1]|max_length[11]'
		),
		'start_dates' => array(
			'field' => 'start_dates', 
			'label' => 'start_dates', 
			'rules' => 'trim'
		),	
		'price' => array(
			'field' => 'price', 
			'label' => 'price', 
			'rules' => 'trim|required|max_length[50]'
		),
		'school_id' => array(
			'field' => 'school_id', 
			'label' => 'school', 
			'rules' => 'trim|max_length[11]|required'
		),
		'notes' => array(
			'field' => 'notes',
			'label' => 'notes',
			'rules' => 'trim|max_length[1000]'
		),
		'active' => array(
			'field' => 'active', 
			'label' => 'active', 
			'rules' => 'trim|max_length[1]'
		),
	);

	public function get_new ()
	{
		$slider = new stdClass();
		$slider->name = '';
		$slider->duration = 1;
		$slider->price = 0.00;
		$slider->start_dates = '';
		$slider->school_id = '';
		$slider->notes = '';         
		$slider->active = '';
		return $slider;
	}


}