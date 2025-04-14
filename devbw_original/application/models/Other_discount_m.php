<?php
class Other_discount_m extends MY_Model
{
	protected $_table_name = 'other_discount';
	protected $_order_by = 'id asc';
	public $rules = array(
		'region_id' => array(
			'field' => 'region_id', 
			'label' => 'Region', 
			'rules' => 'trim|max_length[11]'
		),'registration_fee_off' => array(
			'field' => 'registration_fee_off', 
			'label' => 'Registration fees waved after week', 
			'rules' => 'trim|max_length[11]'
		),'accommodation_fee_off' => array(
			'field' => 'accommodation_fee_off', 
			'label' => 'Accommodation fees waved after week', 
			'rules' => 'trim|max_length[11]'
		),'arrival_off' => array(
			'field' => 'arrival_off', 
			'label' => 'Arrival fees waved after week', 
			'rules' => 'trim|max_length[11]'
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
		$slider->region_id = '';
		$slider->registration_fee_off = '';
		$slider->accommodation_fee_off = '';
		$slider->arrival_off = '';
		$slider->made_by = '';
		$slider->active = '';
		return $slider;
	}


}