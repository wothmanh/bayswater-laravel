<?php
class Courses_Premium_m extends MY_Model
{
	protected $_table_name = 'courses_premium';
	protected $_order_by = 'id asc';
	
	public $rules = array(
		'name' => array(
			'field' => 'name',
			'label' => 'name',
			'rules' => 'trim|required|max_length[255]'
		),
		'school_id' => array(
			'field' => 'school_id',
			'label' => 'school',
			'rules' => 'trim|required|integer|max_length[11]'
		),
		'active' => array(
			'field' => 'active',
			'label' => 'active',
			'rules' => 'trim|required|integer|max_length[1]'
		),
		'notes' => array(
			'field' => 'notes',
			'label' => 'notes',
			'rules' => 'trim|max_length[1000]'
		),
		'created_at' => array(
			'field' => 'created_at',
			'label' => 'created_at',
			'rules' => 'trim'
		)
		
	);

	public function get_new ()
	{
		$slider = new stdClass();

		$slider->name = '';          
		$slider->school_id = '';      
		$slider->active = 1;          
		$slider->notes = '';          
		$slider->created_at = '';     

		return $slider;

	}

}