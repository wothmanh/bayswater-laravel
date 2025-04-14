<?php
class Clients_m extends MY_Model
{
	protected $_table_name = 'clients';
	protected $_order_by = 'id desc';
	public $rules = array(
		'file_num' => array(
			'field' => 'file_num', 
			'label' => 'file number', 
			'rules' => 'trim|max_length[100]|callback__unique_client|callback__num_erformat'
		),'first_name' => array(
			'field' => 'first_name', 
			'label' => 'first name', 
			'rules' => 'trim|required|max_length[100]'
		),'last_name' => array(
			'field' => 'last_name', 
			'label' => 'last name', 
			'rules' => 'trim|required|max_length[100]'
		),'gender' => array(
			'field' => 'gender', 
			'label' => 'gender', 
			'rules' => 'trim|max_length[100]'
		),'img' => array(
			'field' => 'img', 
			'label' => 'Client picture', 
			'rules' => 'trim|max_length[100]'
		),'email' => array(
			'field' => 'email', 
			'label' => 'email', 
			'rules' => 'trim|max_length[100]|valid_email'
		),'address' => array(
			'field' => 'address', 
			'label' => 'address', 
			'rules' => 'trim'
		),'city' => array(
			'field' => 'city', 
			'label' => 'city', 
			'rules' => 'trim|max_length[100]'
		),'country' => array(
			'field' => 'country', 
			'label' => 'country', 
			'rules' => 'trim|max_length[100]'
		),'phone' => array(
			'field' => 'phone', 
			'label' => 'phone', 
			'rules' => 'trim|max_length[100]'
		),'heard_about_us' => array(
			'field' => 'heard_about_us', 
			'label' => 'heard about us', 
			'rules' => 'trim|max_length[100]'
		),'visa_type' => array(
			'field' => 'visa_type', 
			'label' => 'visa type', 
			'rules' => 'trim|max_length[100]'
		),'passport' => array(
			'field' => 'passport', 
			'label' => 'passport', 
			'rules' => 'trim|max_length[100]'
		),'certificates' => array(
			'field' => 'certificates', 
			'label' => 'certificates', 
			'rules' => 'trim|max_length[100]'
		),'birthday' => array(
			'field' => 'birthday', 
			'label' => 'birthday', 
			'rules' => 'trim|max_length[100]'
		),'post_code' => array(
			'field' => 'post_code', 
			'label' => 'post_code', 
			'rules' => 'trim|max_length[100]'
		),'made_by' => array(
			'field' => 'made_by', 
			'label' => 'made_by', 
			'rules' => 'trim|max_length[100]'
		),
		'pdf_get_valclient' => array(
			'field' => 'pdf_get_valclient', 
			'label' => 'course pdf', 
			'rules' => 'trim'
		),
		'course_price' => array(
			'field' => 'course_price', 
			'label' => 'course price', 
			'rules' => 'trim'
		),
		'active' => array(
			'field' => 'active', 
			'label' => 'active', 
			'rules' => 'trim|max_length[1]'
		),
		'registered_from' => array(
			'field' => 'registered_from', 
			'label' => 'Registered from', 
			'rules' => 'trim|max_length[1]'
		),
		'registered_type' => array(
			'field' => 'registered_type', 
			'label' => 'Registered type', 
			'rules' => 'trim|max_length[1]'
		)
		
	);

	public function get_new ()
	{
		$slider = new stdClass();
		$slider->file_num = '';
		$slider->first_name = '';
		$slider->last_name = '';
		$slider->gender = '';
		$slider->img = 'avatar.jpg';
		$slider->email = '';
		$slider->address = '';
		$slider->city = '';
		$slider->country = '';
		$slider->phone = '';
		$slider->heard_about_us = '';
		$slider->visa_type = '';
		$slider->passport = '';
		$slider->certificates = '';
		$slider->birthday = '';
		$slider->post_code = '';
		$slider->pdf_course = '';
		$slider->course_price = '';
		$slider->made_by = '';
		$slider->registered_from = ''; 
		$slider->registered_type = ''; 
		$slider->active = '';
		$slider->c_couse_weeks = '';
		$slider->c_start = '';

		return $slider;
	}


}