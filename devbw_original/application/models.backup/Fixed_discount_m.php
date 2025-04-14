<?php
class Fixed_discount_m extends MY_Model
{
	protected $_table_name = 'fixed_discount';
	protected $_order_by = 'id asc';
	public $rules = array(
		'sum_course' => array(
			'field' => 'sum_course', 
			'label' => 'Course Fixed Discount', 
			'rules' => 'trim|max_length[10]'
		),'sum_accommo' => array(
			'field' => 'sum_accommo', 
			'label' => 'Accoommodation Fixed Discount', 
			'rules' => 'trim|max_length[10]'
		),'text_course' => array(
			'field' => 'text_course', 
			'label' => 'Note for Course Fixed Discount', 
			'rules' => 'trim|max_length[100]'
		),'text_accommo' => array(
			'field' => 'text_accommo', 
			'label' => 'Note for Accoommodation Fixed Discount', 
			'rules' => 'trim|max_length[100]'
		),
		'made_by' => array(
			'field' => 'made_by', 
			'label' => 'made_by', 
			'rules' => 'trim|max_length[11]'
		),
		'region_id' => array(
			'field' => 'region_id', 
			'label' => 'region_id', 
			'rules' => 'trim|required|max_length[11]'
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
		$slider->sum_course = '';
		$slider->text_course = '';
		$slider->sum_accommo = '';
		$slider->text_accommo = '';
		$slider->made_by = '';
		$slider->region_id = '';
		$slider->active = '';
		return $slider;
	}


}