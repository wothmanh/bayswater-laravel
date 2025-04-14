<?php
class Courses_Exam_Prices_m extends MY_Model
{
	protected $_table_name = 'courses_exam_prices';
	protected $_order_by = 'id asc';
	public $rules = array(
		'duration' => array(
			'field' => 'duration', 
			'label' => 'duration', 
			'rules' => 'trim|integer'
		),
		'price' => array(
			'field' => 'price', 
			'label' => 'price', 
			'rules' => 'trim|required|max_length[50]'
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
		$slider->duration = 1;
		$slider->price = '';
		$slider->active = '';
		return $slider;
	}


}