<?php
class Currency_m extends MY_Model
{
	protected $_table_name = 'currency';
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
		'sar_price' => array(
			'field' => 'SAR price', 
			'label' => 'SAR price', 
			'rules' => 'trim|max_length[20]'
		)
		
	);

	public function get_new ()
	{
		$slider = new stdClass();
		$slider->name = '';
		$slider->active = '';
		$slider->sar_price = '';
		return $slider;
	}


}