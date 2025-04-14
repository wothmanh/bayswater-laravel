<?php
class Payments_m extends MY_Model
{
	protected $_table_name = 'payments';
	protected $_order_by = 'id desc';
	public $rules = array(
		'price' => array(
			'field' => 'price', 
			'label' => 'price', 
			'rules' => 'trim|required|max_length[50]'
		),
		'currency_id' => array(
			'field' => 'currency_id', 
			'label' => 'currency_id', 
			'rules' => 'trim'
		),
		'made_by' => array(
			'field' => 'made_by', 
			'label' => 'made_by', 
			'rules' => 'trim|max_length[11]'
		)
		
		
	);

	public function get_new ()
	{
		$slider = new stdClass();
		$slider->price = '';
		$slider->currency_id = '';
		$slider->made_by = '';
		return $slider;
	}


}