<?php
class Courses_Addons_m extends MY_Model
{
	protected $_table_name = 'courses_addons';
	protected $_order_by = 'id asc';
	
	public $rules = array(
		'name' => array(
			'field' => 'name',
			'label' => 'name',
			'rules' => 'trim|required|max_length[255]'
		),
		'lessons' => array(
			'field' => 'lessons',
			'label' => 'lessons',
			'rules' => 'trim|required|integer|min_length[1]|max_length[11]'
		),
		'school_id' => array(
			'field' => 'school_id',
			'label' => 'school',
			'rules' => 'trim|required|integer|max_length[11]'
		),
		'price' => array(
			'field' => 'price',
			'label' => 'price',
			'rules' => 'trim|required|max_length[10]'
		),
		'active' => array(
			'field' => 'active',
			'label' => 'active',
			'rules' => 'trim|required|integer|max_length[1]'
		),
		'notes' => array(
			'field' => 'notes',
			'label' => 'notes',
			'rules' => 'trim|max_length[1000]'
		),
		'created_at' => array(
			'field' => 'created_at',
			'label' => 'created_at',
			'rules' => 'trim'
		)
		
	);

	public function get_new ()
	{
		$slider = new stdClass();

		$slider->name = '';           // Course name
		$slider->lessons = 1;         // Default number of lessons (assuming 1 lesson by default)
		$slider->school_id = '';      // Default school_id (empty if not set)
		$slider->price = 0.00;        // Default price (assuming 0.00 if not set)
		$slider->active = 1;          // Default active status (assuming 1 means active)
		$slider->notes = '';          // Default empty notes
		$slider->created_at = '';     // Created at timestamp (set automatically by DB)

		return $slider;

	}


}