<?php
class Schools_m extends MY_Model
{
	protected $_table_name = 'schools';
	protected $_order_by = 'id asc';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'name', 
			'rules' => 'trim|max_length[100]'
		),
		'active' => array(
			'field' => 'active', 
			'label' => 'active', 
			'rules' => 'trim|max_length[1]'
		),
		'country_id' => array(
			'field' => 'country', 
			'label' => 'country', 
			'rules' => 'trim|max_length[11]'
		),
		'city_id' => array(
			'field' => 'city', 
			'label' => 'city', 
			'rules' => 'trim|max_length[11]'
		),
		'address' => array(
			'field' => 'address', 
			'label' => 'address', 
			'rules' => 'trim|max_length[200]'
		),
		'insurance' => array(
			'field' => 'insurance', 
			'label' => 'insurance', 
			'rules' => 'trim|max_length[50]'
		),
		'registration_fee' => array(
			'field' => 'registration fee', 
			'label' => 'registration fee', 
			'rules' => 'trim|max_length[50]'
        ),
        'bank_charges' => array(
			'field' => 'Bank charges', 
			'label' => 'Bank charges', 
			'rules' => 'trim|max_length[50]'
        ),
        'custodianship_fee' => array(
			'field' => 'custodianship fee', 
			'label' => 'custodianship fee', 
			'rules' => 'trim|max_length[5]'
        ),
		'accommodation_fee' => array(
			'field' => 'accommodation fee', 
			'label' => 'accommodation fee', 
			'rules' => 'trim|max_length[50]'
        ),
        'guardianship_fee' => array(
			'field' => 'guardianship fee', 
			'label' => 'guardianship fee', 
			'rules' => 'trim|max_length[50]'
		),
        'christmas_fee' => array(
			'field' => 'christmas fee', 
			'label' => 'christmas fee', 
			'rules' => 'trim|max_length[50]'
		),
        'christmas_start' => array(
			'field' => 'christmas start', 
			'label' => 'christmas start', 
			'rules' => 'trim|max_length[50]'
		),
        'christmas_end' => array(
			'field' => 'christmas end', 
			'label' => 'christmas end', 
			'rules' => 'trim|max_length[50]'
		),
		'books_fee' => array(
			'field' => 'books fee', 
			'label' => 'books fee', 
			'rules' => 'trim|max_length[50]'
		),
		'books_weeks' => array(
			'field' => 'Books fee per weeks', 
			'label' => 'Books fee per weeks', 
			'rules' => 'trim|max_length[5]'
		),
		'aramix_fee' => array(
			'field' => 'aramix fee', 
			'label' => 'aramix fee', 
			'rules' => 'trim|max_length[50]'
		),
		'currency_id' => array(
			'field' => 'currency', 
			'label' => 'currency', 
			'rules' => 'trim|max_length[50]'
		),
		'summer_fees' => array(
			'field' => 'summer extra', 
			'label' => 'summer extra', 
			'rules' => 'trim|max_length[50]'
        ),
        'summer_supp_week_off' => array(
			'field' => 'Summer supp off after', 
			'label' => 'Summer supp off after', 
			'rules' => 'trim|max_length[3]'
		),
		'smr_s_note' => array(
			'field' => 'summer supp note', 
			'label' => 'summer supp note', 
			'rules' => 'trim|max_length[50]'
		),
		'smr_s_dt_start' => array(
			'field' => 'summer supp date start', 
			'label' => 'summer supp date start', 
			'rules' => 'trim|max_length[50]'
		),
		'smr_s_dt_ends' => array(
			'field' => 'summer supp date ends', 
			'label' => 'summer supp date ends', 
			'rules' => 'trim|max_length[50]'
		),


		'qf_all_courses_include' => array(
			'field' => 'qf_all_courses_include', 
			'label' => 'All courses include', 
			'rules' => 'trim|max_length[200]'
		),
		'qf_professional_courses' => array(
			'field' => 'qf_professional_courses', 
			'label' => 'Professional courses', 
			'rules' => 'trim|max_length[200]'
		),
		'qf_english_courses' => array(
			'field' => 'qf_english_courses', 
			'label' => 'English courses', 
			'rules' => 'trim|max_length[200]'
		),
		'qf_english_lessons' => array(
			'field' => 'qf_english_lessons', 
			'label' => 'English lessons', 
			'rules' => 'trim|max_length[200]'
		),
		'qf_closure_dates' => array(
			'field' => 'qf_closure_dates', 
			'label' => 'Closure dates', 
			'rules' => 'trim|max_length[200]'
		),
		'qf_classrooms' => array(
			'field' => 'qf_classrooms', 
			'label' => 'Classrooms', 
			'rules' => 'trim|max_length[200]'
		),

		
		'qf_capacity' => array(
			'field' => 'qf_capacity', 
			'label' => 'Capacity', 
			'rules' => 'trim|max_length[200]'
		),
		'qf_max_class_size' => array(
			'field' => 'qf_max_class_size', 
			'label' => 'Max class size', 
			'rules' => 'trim|max_length[200]'
		),
		'qf_test_centre' => array(
			'field' => 'qf_test_centre', 
			'label' => 'Test centre', 
			'rules' => 'trim|max_length[200]'
		),
		'qf_notes' => array(
			'field' => 'qf_notes', 
			'label' => 'Notes', 
			'rules' => 'trim|max_length[200]'
		),
		'qf_file_link' => array(
			'field' => 'qf_file_link', 
			'label' => 'File link', 
			'rules' => 'trim|max_length[200]'
		),
		
	);

	public function get_new ()
	{
		$slider = new stdClass();
		$slider->name = '';
		$slider->active = '';
		$slider->country_id = '';
		$slider->city_id = '';
		$slider->address = '';
		$slider->insurance = '';
		$slider->registration_fee = '';
		$slider->bank_charges = 0;
		$slider->custodianship_fee = 0;
		$slider->accommodation_fee = '';
		$slider->guardianship_fee = '';
		$slider->christmas_fee = '';
		$slider->christmas_start = '';
		$slider->christmas_end = '';
		$slider->books_fee = '';
		$slider->books_weeks = 0;
		$slider->aramix_fee = '';
		$slider->currency_id = '';
		$slider->summer_fees = '';
		$slider->summer_supp_week_off = '';
		$slider->smr_s_note = '';
		$slider->smr_s_dt_start = '';
		$slider->smr_s_dt_ends = '';


		$slider->qf_all_courses_include = '';
		$slider->qf_professional_courses = '';
		$slider->qf_english_courses = '';

		return $slider;
	}


}