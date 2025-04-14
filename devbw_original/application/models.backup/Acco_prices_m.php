<?php
class Acco_prices_m extends MY_Model
{
	protected $_table_name = 'acco_prices';
	protected $_order_by = 'id asc';
	public $rules = array(
		'start' => array(
			'field' => 'start', 
			'label' => 'start', 
			'rules' => 'trim|required|max_length[20]'
		),
		'ends' => array(
			'field' => 'ends', 
			'label' => 'ends', 
			'rules' => 'trim|required|max_length[20]'
		),
		'price' => array(
			'field' => 'price', 
			'label' => 'price', 
			'rules' => 'trim|required|max_length[50]'
		),
		'made_by' => array(
			'field' => 'made_by', 
			'label' => 'made_by', 
			'rules' => 'trim|max_length[11]'
		),
		'type' => array(
			'field' => 'type', 
			'label' => 'type', 
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
		$slider = new stdClass();
		$slider->active = '';
		$slider->start = '';
		$slider->ends = '';
		$slider->type = '';
		$slider->price = '';
		$slider->made_by = '';
		return $slider;
	}


}