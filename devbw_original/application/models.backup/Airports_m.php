<?php
class Airports_m extends MY_Model
{
	protected $_table_name = 'airports';
	protected $_order_by = 'id asc';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'name', 
			'rules' => 'trim|required|max_length[100]'
		),
		'active' => array(
			'field' => 'active', 
			'label' => 'active', 
			'rules' => 'trim|max_length[1]'
		),
		'school_id' => array(
			'field' => 'school', 
			'label' => 'school', 
			'rules' => 'trim|max_length[11]'
		),
		'arrival_price' => array(
			'field' => 'arrival price', 
			'label' => 'arrival price', 
			'rules' => 'trim|max_length[50]'
		),
		'departure_price' => array(
			'field' => 'departure price', 
			'label' => 'departure price', 
			'rules' => 'trim|max_length[50]'
		)
		
	);

	public function get_new ()
	{
		$slider = new stdClass();
		$slider->name = '';
		$slider->active = '';
		$slider->school_id = '';
		$slider->arrival_price = '';
		$slider->departure_price = '';
		return $slider;
	}


}