<?php
class Courses_Exam_m extends MY_Model
{
	protected $_table_name = 'courses_exam';
	protected $_order_by = 'id asc';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'name', 
			'rules' => 'trim|max_length[100]'
		),
		'lessons' => array(
			'field' => 'lessons',
			'label' => 'lessons',
			'rules' => 'trim|required|integer|min_length[1]|max_length[11]'
		),
		'start_dates' => array(
			'field' => 'start_dates', 
			'label' => 'start_dates', 
			'rules' => 'trim'
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
		$slider->lessons = 1;
		$slider->start_dates = '';
		$slider->school_id = '';
		$slider->notes = '';         
		$slider->active = '';
		return $slider;
	}

}