<?php
class Cities_m extends MY_Model
{
	protected $_table_name = 'cities';
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
		'country_id' => array(
			'field' => 'country', 
			'label' => 'country', 
			'rules' => 'trim'
		)
		
	);

	public function get_new ()
	{
		$slider = new stdClass();
		$slider->name = '';
		$slider->country_id = '';
		$slider->active = '';
		return $slider;
	}


}