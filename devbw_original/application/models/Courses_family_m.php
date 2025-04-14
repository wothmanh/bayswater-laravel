<?php
class Courses_Family_m extends MY_Model
{
	protected $_table_name = 'courses_family';
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
		'age_from' => array(
			'field' => 'age_from',
			'label' => 'age_from',
			'rules' => 'trim|required|integer|max_length[11]'
		),
		'age_to' => array(
			'field' => 'age_to',
			'label' => 'age_to',
			'rules' => 'trim|required|integer|max_length[11]'
		),
		'extra' => array(
			'field' => 'extra',
			'label' => 'extra',
			'rules' => 'trim|required|max_length[10]'
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
		'date_from' => array(
			'field' => 'date_from',
			'label' => 'date_from',
			'rules' => 'trim|required'
		),
		'date_to' => array(
			'field' => 'date_to',
			'label' => 'date_to',
			'rules' => 'trim|required'
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

		$slider->name = '';          
		$slider->age_from = 0;          
		$slider->age_to = 0;            
		$slider->lessons = 1;          
		$slider->school_id = '';      
		$slider->price = 0.00;        
		$slider->extra = 0.00;     
		$slider->date_from = '';       
		$slider->date_to = '';          
		$slider->active = 1;          
		$slider->notes = '';          
		$slider->created_at = '';     

		return $slider;

	}

}