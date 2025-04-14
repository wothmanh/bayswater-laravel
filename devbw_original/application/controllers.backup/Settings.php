<?php
class Settings extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		if($this->data['user_group']->settings == 0) redirect('fees_calculator');
	}

	public function index ()
	{
		$rules = $this->settings_m->rules;
		$this->form_validation->set_rules($rules);
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->settings_m->array_from_post(array('websiteName', 'keywords', 'description','pdf_footer','pdf_title'));

		    $this->load->library('upload');
		    if (!empty($_FILES['logo']['tmp_name'])) {
				$config['upload_path'] = './img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['encrypt_name'] = TRUE;
				$config['max_size']  = '5000';
				$this->upload->initialize($config); 
				$this->upload->do_upload("logo"); 
				$file_data = $this->upload->data(); 
				$resize_me['image_library'] = 'gd2';
				$resize_me['source_image'] = $file_data['full_path'];
				$resize_me['create_thumb'] = FALSE;
				$resize_me['maintain_ratio'] = FALSE;
				$resize_me['width'] = '180';
				$resize_me['height'] = '65';	
				$this->load->library('image_lib', $resize_me); 
				$this->image_lib->resize();
				$data['logo'] = $file_data['file_name'];
			}
			if (!empty($_FILES['favicon']['tmp_name'])) {
				$config['upload_path'] = './img/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
				$config['encrypt_name'] = TRUE;
				$config['max_size']  = '5000';
				$this->upload->initialize($config); 
				$this->upload->do_upload("favicon"); 
				$file_data = $this->upload->data(); 
				$resize_me['image_library'] = 'gd2';
				$resize_me['source_image'] = $file_data['full_path'];
				$resize_me['create_thumb'] = FALSE;
				$resize_me['maintain_ratio'] = FALSE;
				$resize_me['width'] = '20';
				$resize_me['height'] = '20';	
				$this->load->library('image_lib', $resize_me); 
				$this->image_lib->resize();
				$data['favicon'] = $file_data['file_name'];
			}

			$this->settings_m->save($data, 1);
			$this->session->set_flashdata('result', 'Your settings has been updated successfully');
			redirect('settings');
		}
		
		$this->data['subview'] = 'admin/settings/index';
		$this->load->view('admin/_layout_main', $this->data);
	}




}