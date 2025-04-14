<?php
class Settings_m extends MY_Model
{
	protected $_table_name = 'settings';
	protected $_order_by = 'id desc';
	public $rules = array(
		'logo' => array(
			'field' => 'logo', 
			'label' => 'Website logo', 
			'rules' => 'trim|max_length[200]'
		), 
		'websitename' => array(
			'field' => 'websitename', 
			'label' => 'Website name', 
			'rules' => 'trim|max_length[100]'
		),
		'keyworks' => array(
			'field' => 'keyworks', 
			'label' => 'Website keyworks', 
			'rules' => 'trim'
		), 
		'description' => array(
			'field' => 'description', 
			'label' => 'Website description', 
			'rules' => 'trim'
		), 
		'background' => array(
			'field' => 'background', 
			'label' => 'Homepage background', 
			'rules' => 'trim|max_length[200]'
		),
		'favicon' => array(
			'field' => 'favicon', 
			'label' => 'Website favicon', 
			'rules' => 'trim|max_length[200]'
		),
		'pdf_footer' => array(
			'field' => 'pdf_footer', 
			'label' => 'pdf footer', 
			'rules' => 'trim'
		),
		'pdf_title' => array(
			'field' => 'pdf_title', 
			'label' => 'pdf title', 
			'rules' => 'trim|max_length[50]'
		),
		'allow_description' => array(
			'field' => 'allow_description', 
			'label' => 'Allow description', 
			'rules' => 'trim|max_length[50]'
		)

	);

	public function get_new ()
	{
		$settings = new stdClass();
		$settings->logo = '';
		$settings->websitename = '';
		$settings->keyworks = '';
		$settings->description = '';
		$settings->background = '';
		$settings->pdf_footer = '';
		$settings->pdf_title = '';
		$settings->favicon = '';
		$settings->allow_description = '0';
		return $settings;
	}


}