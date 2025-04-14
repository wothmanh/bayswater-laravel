<?php
class Accomo_discount_m extends MY_Model
{
	protected $_table_name = 'accomo_discount';
	protected $_order_by = 'id asc';
	public $rules = array(
		'start' => array(
			'field' => 'start', 
			'label' => 'start', 
			'rules' => 'trim|required'
		),
		'ends' => array(
			'field' => 'ends', 
			'label' => 'ends', 
			'rules' => 'trim|required|max_length[20]'
		),
		'discount' => array(
			'field' => 'discount', 
			'label' => 'discount', 
			'rules' => 'trim|required|max_length[50]'
		),
		'made_by' => array(
			'field' => 'made_by', 
			'label' => 'made_by', 
			'rules' => 'trim|max_length[11]'
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
		$slider->active = '';
		$slider->start = '';
		$slider->ends = '';
		$slider->discount = 0;
		$slider->made_by = '';
		return $slider;
	}


}