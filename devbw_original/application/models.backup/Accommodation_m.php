<?php
class Accommodation_m extends MY_Model
{
	protected $_table_name = 'accommodation';
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
		'a_summer_fees' => array(
			'field' => 'summer fees', 
			'label' => 'summer fees', 
			'rules' => 'trim|max_length[10]'
		),
		'a_smr_s_dt_start' => array(
			'field' => 'summer fees start', 
			'label' => 'summer fees start', 
			'rules' => 'trim|max_length[50]'
		),
		'a_smr_s_dt_ends' => array(
			'field' => 'summer fees end', 
			'label' => 'summer fees end', 
			'rules' => 'trim|max_length[50]'
		),
		'a_smr_s_note' => array(
			'field' => 'summer fees not', 
			'label' => 'summer fees not', 
			'rules' => 'trim|max_length[100]'
        ),
        'guardianship_on' => array(
			'field' => 'guardianship fee', 
			'label' => 'guardianship fee', 
			'rules' => 'trim|max_length[1]'
        ),
        'christmas_on' => array(
			'field' => 'christmas fee', 
			'label' => 'christmas fee', 
			'rules' => 'trim|max_length[1]'
		),
		'type' => array(
			'field' => 'type', 
			'label' => 'type', 
			'rules' => 'trim|max_length[1]'
		)
	);

	public function get_new ()
	{
		$slider = new stdClass();
		$slider->name = '';
		$slider->type = '';
		$slider->active = '';
		$slider->school_id = '';
		$slider->a_summer_fees = '';
		$slider->a_smr_s_dt_start = '';
		$slider->a_smr_s_dt_ends = '';
		$slider->a_smr_s_note = '';
		$slider->guardianship_on = '0';
		$slider->christmas_on = '0';
		return $slider;
	}


}