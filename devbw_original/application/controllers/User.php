<?php
class User extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();

	}



	public function index ()
	{
		if($this->data['user_group']->admins == 1) {

			$this->data['alladmins']["1"] = "Super Admin";
		 	$this->data['alladmins']["2"] = "Admin";
		 	$this->data['alladmins']['3'] = 'Normal user';
		 	$this->data['allbranches']['0'] = '';
		 	foreach ($this->branches_m->get_where(array('active' => 1)) as $key => $value) {
		 		 $this->data['allbranches'][$value->id] = $value->name;
		 	}

			$this->data['users_groups'][''] = 'Choose User Group';
			foreach ($this->users_groups_m->get_records_where('id,name') as $key ){
		        $this->data['users_groups'][$key->id] =   $key->name;
		    }


			$paginate_info = paginate_it('user/index', 20, $this->user_m->record_count(), 3, ''); 
	        $this->data['users'] = $this->user_m->get_limit($paginate_info["per_page"], $paginate_info['page']);
	        $this->data['links'] = $paginate_info['links'];
			$this->data['subview'] = 'admin/user/index';
			$this->load->view('admin/_layout_main', $this->data);
		} else redirect('fees_calculator');
	}

	public function groups ()  
	{
		if($this->data['user_group']->users_groups == 1) {
			$paginate_info = paginate_it('user/index', 20, $this->user_m->record_count(), 3, ''); 
	        $this->data['users_groups'] = $this->users_groups_m->get_limit($paginate_info["per_page"], $paginate_info['page']);
	        $this->data['links'] = $paginate_info['links'];
			$this->data['subview'] = 'admin/user/users_groups';
			$this->load->view('admin/_layout_main', $this->data);
		} else redirect('fees_calculator');
	}	

	public function edit_group ($id = NULL)
	{
		if($this->data['user_group']->users_groups == 1) {
			if ($id) {
				$this->data['user'] = $this->users_groups_m->get($id);
				!is_null($this->data['user']) || $this->data['errors'][] = 'Group could not be found';
			}
			else {
				$this->data['user'] = $this->users_groups_m->get_new();
			}

			$this->data['state']['1'] = 'Active';
		 	$this->data['state']["0"] = "Deactivate";

		 	$this->data['permiss']['1'] = 'Yes';
		 	$this->data['permiss']["0"] = "No";
			
			$rules = $this->users_groups_m->rules;
			$this->form_validation->set_rules($rules);
			
			if ($this->form_validation->run() == TRUE) {
			
				$data = $this->users_groups_m->array_from_post(array(
					'name', 'description','active','settings','courses','schools','airports','branches','accommodation','admins','users_groups','countries','cities','clients','currency'));
				$this->users_groups_m->save($data, $id);
				redirect('user/groups');

			}
			
			$this->data['subview'] = 'admin/user/edit_group';
			$this->load->view('admin/_layout_main', $this->data);
		} else redirect('fees_calculator');
	}


	public function edit ($id = NULL)
	{
		if ($id) {
			$this->data['user'] = $this->user_m->get($id);
			!is_null($this->data['user']) || $this->data['errors'][] = 'User could not be found';
		}
		else {
			$this->data['user'] = $this->user_m->get_new();
		}

		

		if($this->data['user_group']->admins == 1) {

		 	$this->data['alladmins']["1"] = "Super Admin";
		 	$this->data['alladmins']["2"] = "Admin";
		 	$this->data['alladmins']['3'] = 'Normal user';

		 	$this->data['allbranches']['0'] = '';
		 	foreach ($this->branches_m->get_where(array('active' => 1)) as $key => $value) {
		 		 $this->data['allbranches'][$value->id] = $value->name;
		 	}

			$this->data['users_groups'][''] = 'Choose User Group';
			foreach ($this->users_groups_m->get_records_where('id,name') as $key ){
		        $this->data['users_groups'][$key->id] =   $key->name;
		    }
		
		}

		if($this->data['user_group']->admins == 1) {

		$rules = $this->user_m->rules_admin;
		$id || $rules['password']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {


		
			if ($this->input->post('password') !='') {
				$data = $this->user_m->array_from_post(array('name', 'email','branch','users_groups', 'password'));
				$data['password'] = $this->user_m->hash($data['password']);
			} else {
				if($this->data['user_group']->admins == 1) {
					$data = $this->user_m->array_from_post(array('name', 'email','branch','users_groups'));
				} else {
					$data = $this->user_m->array_from_post(array('name', 'email', 'branch'));
				}
			}


			if (!empty($_FILES['img']['tmp_name'])) {
				$this->load->library('upload');	
				$config['upload_path'] = './img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['encrypt_name'] = TRUE;
				$config['max_size']  = '5000';
				$this->upload->initialize($config); 
				$this->upload->do_upload("img"); 
				$file_data = $this->upload->data(); 
				$resize_me['image_library'] = 'gd2';
				$resize_me['source_image'] = $file_data['full_path'];
				$resize_me['create_thumb'] = FALSE;
				$resize_me['maintain_ratio'] = FALSE;
				$resize_me['width'] = '200';
				$resize_me['height'] = '200';	
				$this->load->library('image_lib', $resize_me); 
				$this->image_lib->resize();
				$data['img'] = $file_data['file_name'];
			}
			
	
			$this->user_m->save($data, $id);
			redirect('user');
/*			echo "<pre>";
		print_r($data);*/
		}
		}
		
		$this->data['subview'] = 'admin/user/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete_group ($id)
	{
		if($this->data['user_group']->users_groups == 1) {
			$this->users_groups_m->delete($id);
			redirect('user/groups');
		} else redirect('fees_calculator');
	}
	public function delete ($id)
	{
		if($this->data['user_group']->admins == 1) {
			$this->user_m->delete($id);
			redirect('user');
		} else redirect('fees_calculator');
	}

	public function login ()
	{
	    
	   // echo $this->user_m->login();
	   // exit();
		$dashboard = 'fees';
		$this->user_m->loggedin() == FALSE || redirect($dashboard);
		
		$rules = $this->user_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			if ($this->user_m->login() == TRUE) {
				redirect($dashboard);
			}
			else {
				$this->session->set_flashdata('error', 'That Username/password combination does not exist');
				//redirect('user/login', 'refresh');
			}
		}
		
		$this->load->view('admin/user/login', $this->data);
	}

	public function logout ()
	{
		$this->user_m->logout();
		redirect('user/login');
	}

	public function _unique_email ($str)
	{		
		$id = $this->uri->segment(4);
		$this->db->where('email', $this->input->post('email'));
		!$id || $this->db->where('id !=', $id);
		$user = $this->user_m->get();
		
		if (!is_null($user)) {
			$this->form_validation->set_message('_unique_email', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}

	public function getnotifications() 
   	{
        $usrid = $this->session->userdata('id'); 
        $arr_date = array('user_id' => $usrid, 'seen' => 0 ,'active' => 1 , 'date' => date('Y-m-d'), 'time <' => date('H:i'));
        $mynoti = $this->notifications_m->get_where($arr_date,NULL, TRUE);
        
		if (!empty($mynoti)) {
        	$this->notifications_m->save_where(array('seen' => 1) , array('user_id' => $usrid, 'date' => date('Y-m-d'), 'time <' => date('H:i')));
			$data = array(
					'notis' => 1,
                    'notification' => $mynoti
                    );
        	echo json_encode($data);
		} else {
			$data = array(
					'notis' => 0
                    );
        	echo json_encode($data);
		}




    }




}