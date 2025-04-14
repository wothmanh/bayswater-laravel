<?php
class Notes_m extends MY_Model
{
	protected $_table_name = 'notes';
	protected $_order_by = 'id desc';
	public $rules = array(
		'note' => array(
			'field' => 'note', 
			'label' => 'note', 
			'rules' => 'trim|required'
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
		$slider->note = '';
		$slider->made_by = '';
		$slider->ndate = date("Y-m-d");
		$slider->ntime = '';
		$slider->onoff = 0;
		return $slider;
	}


}