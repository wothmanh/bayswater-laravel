<?php
class Clients extends Admin_Controller
{


	public function __construct ()
	{
		parent::__construct();
	}


	public function index ()
	{
		$c_start = $c_ends = false;

		$this->data['countries_all'][''] = '- - Select country - -';
	 	foreach ($this->countries_m->get_records_where('id,name',array('active'=>1)) as $key ){
	        $this->data['countries_all'][$key->id] = $this->libre->country($key->name);
	    }
	    $this->data['cities_all'][''] = '- - Select City - -';
	    foreach ($this->cities_m->get_records_where('id,name',array('active'=>1)) as $key ){
	        $this->data['cities_all'][$key->id] = $key->name;
	    }
	 	$this->data['centers_all'][''] = '- - Select Centre - -';
	 	foreach ($this->schools_m->get_records_where('id,name',array('active'=>1)) as $key ){
	        $this->data['centers_all'][$key->id] = $key->name;
	    }

		$this->_array_hlps();

		$erwhere = array();

		switch ($this->session->userdata('admin')) {
			case 1:
				$this->data['users_all'][''] = 'All users';
				foreach ($this->user_m->get_records_where('id,name') as $key ){
			        $this->data['users_all'][$key->id] =   $key->name;
			    }
			    $this->data['allbranches'][''] = 'All branches';
			    foreach ($this->branches_m->get_where(array('active' => 1)) as $key => $value) {
			 		 $this->data['allbranches'][$value->id] = $value->name;
			 	}


			 	// search
			 	if ($this->input->get('search_query') !== FALSE) {
					if ($_GET['branch'] != '')  $erwhere['branch'] = $_GET['branch'];
					if ($_GET['usrs'] != '') $erwhere['made_by'] = $_GET['usrs'];
					if ($_GET['registered_type'] != '') $erwhere['registered_type'] = $_GET['registered_type'];
					if ($_GET['active'] != '') $erwhere['active'] = $_GET['active'];
					if ($_GET['country'] != '') $erwhere['c_country_id'] = $_GET['country'];
					if ($_GET['city'] != '') $erwhere['c_city_id'] = $_GET['city'];
					if ($_GET['school'] != '') $erwhere['c_school_id'] = $_GET['school'];
					if ($_GET['c_start'] != 'Start') $erwhere['c_start'] = $_GET['c_start'];
					if ($_GET['c_ends'] != 'End') $erwhere['c_ends'] = $_GET['c_ends'];				
				} 

				break;
			case 2:
				$this->data['users_all'][''] = 'Users';
				foreach ($this->user_m->get_records_where('id,name',array('branch' => $this->session->userdata('branch'))) as $key ){
			        $this->data['users_all'][$key->id] =   $key->name;
			    }
				$erwhere['branch'] = $this->session->userdata('branch');

				// search
			 	if ($this->input->get('search_query') !== FALSE) {
					if ($_GET['usrs']) $erwhere['made_by'] = $_GET['usrs'];
					if ($_GET['registered_type']) $erwhere['registered_type'] = $_GET['registered_type'];
					if ($_GET['active']) $erwhere['active'] = $_GET['active'];
					if ($_GET['country']) $erwhere['c_country_id'] = $_GET['country'];
					if ($_GET['city']) $erwhere['c_city_id'] = $_GET['city'];
					if ($_GET['school']) $erwhere['c_school_id'] = $_GET['school'];
					if ($_GET['c_start'] != 'Start') $erwhere['c_start'] = $_GET['c_start'];
					if ($_GET['c_ends'] != 'End') $erwhere['c_ends'] = $_GET['c_ends'];	
				} 
				break;
			case 3:
				$erwhere['made_by'] = $this->session->userdata('id');
				// search
			 	if ($this->input->get('search_query') !== FALSE) {
					if ($_GET['registered_type']) $erwhere['registered_type'] = $_GET['registered_type'];
					if ($_GET['active']) $erwhere['active'] = $_GET['active'];
					if ($_GET['country']) $erwhere['c_country_id'] = $_GET['country'];
					if ($_GET['city']) $erwhere['c_city_id'] = $_GET['city'];
					if ($_GET['school']) $erwhere['c_school_id'] = $_GET['school'];
					if ($_GET['c_start'] != 'Start') $erwhere['c_start'] = $_GET['c_start'];
					if ($_GET['c_ends'] != 'End') $erwhere['c_ends'] = $_GET['c_ends'];	
				} 
				break;
			default:
				redirect('fees_calculator');
				break;
		}


		$paginate_info = paginate_it('clients/index/', 20, $this->clients_m->coulients('clients',$erwhere), 3, ''); 
        $this->data['clients'] = $this->clients_m->get_llients($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/clients/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function single ($client_id)
	{
		$this->data['status'][''] = 'Payments';
		$this->data['status']['0'] = 'Not Paid';
	 	$this->data['status']["1"] = "Paid Advance";
	 	$this->data['status']["2"] = "Paid";
        $this->data['clients'] = $this->clients_m->get_llientsff(array('id' => $client_id));
        //$this->data['clients'] = $this->clients_m->get($client_id);
		$this->data['subview'] = 'admin/clients/single';
		$this->load->view('admin/_layout_main', $this->data);
	}






	public function client ($id)
	{
		$this->_array_hlps();
		$this->load->model('notes_m');

        $this->data['client'] = $this->clients_m->get($id);

        $this->data['notes'] = $this->notes_m->get_where(array('client_id' => $id));
        $this->data['paymntsr'] = $this->payments_m->get_where(array('client_id' => $id));

        if (!empty($this->data['paymntsr'])) {
        	$ttslsdf = $this->payments_m->direct_query('SELECT SUM(price)  AS totalpaid FROM payments WHERE client_id = '.$id);
			$this->data['total_paid'] = $ttslsdf[0]->totalpaid.' '.$this->currency_m->id_to_field($this->payments_m->get_records_where('currency_id', array('client_id' => $id),TRUE)->currency_id, 'name');
        } else {
        	$this->data['total_paid'] = "00.00";
        }
		$this->data['subview'] = 'admin/clients/client';
		$this->load->view('admin/_layout_main', $this->data);
	}
	




	public function show_course ($client_id)
	{

        $this->data['client_course_info'] = $this->clients_m->get_records_where('first_name, last_name,pdf_course', $e_where=array('id' => $client_id ), true);

		$this->data['subview'] = 'admin/clients/show_course';
		$this->load->view('admin/_layout_main', $this->data);
	}





	
	
	public function edit ($id = NULL)
	{

		$this->data['weeks_all'] = $this->_weekssellect();
		$this->load->library('upload');	

		if ($id) {
			$this->data['client'] = $this->clients_m->get($id, true);
			!is_null($this->data['client']) || $this->data['errors'][] = 'User could not be found';
		} else {
			$this->data['client'] = $this->clients_m->get_new();
		}

		if ($this->session->userdata('branch') == 2 ) {
			if ( $this->data['client']->branch != $this->session->userdata('branch')) redirect('clients/');
		} elseif ($this->session->userdata('branch') == 3) {
			if ( $this->data['client']->made_by != $this->session->userdata('id')) redirect('clients/');
		}



		$this->_array_hlps();
		
		$rules = $this->clients_m->rules;
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$data = $this->clients_m->array_from_post(array(
				'first_name','last_name','gender','email','file_num',
				'address','city','country','course_price','registered_from','registered_type',
				'phone','heard_about_us','visa_type','passport','certificates','birthday','post_code','active', 'c_couse_weeks', 'c_start' 
			));

if ($data['c_couse_weeks'] && $data['c_start']) {
	$weekshelper = '+'.$data['c_couse_weeks'].' week';
	$data['c_ends'] = date('Y-m-d', strtotime($weekshelper, strtotime($data['c_start'])));
} else $data['c_couse_weeks'] = 0;


			$data['made_by'] = $this->session->userdata('id');
			$data['branch'] = $this->session->userdata('branch');


			if (!empty($_FILES['img']['tmp_name'])) {
				$config['upload_path'] = './uploads/';
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
			
			if (!empty($_FILES['pdf_get_valclient']['tmp_name'])) {
				$config['upload_path'] = './uploads/pdf/';
				$config['allowed_types'] = 'pdf';
				$config['encrypt_name'] = TRUE;
				$config['max_size']  = '50000';
				$this->upload->initialize($config); 
				$this->upload->do_upload("pdf_get_valclient"); 
				$file_data = $this->upload->data(); 
				$data['pdf_course'] = $file_data['file_name'];
			}

			if (!empty($_FILES['passport']['tmp_name'])) {
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'jpg|png|doc|docx|pdf|xls|xlsx|rtf|txt|rar|zip';
				$config['encrypt_name'] = TRUE;
				$config['max_size']  = '50000';
				$this->upload->initialize($config); 
				$this->upload->do_upload("passport"); 
				$file_data = $this->upload->data(); 
				$data['passport'] = $file_data['file_name'];
			}
			if (!empty($_FILES['certificates']['tmp_name'])) {
				$config2['upload_path'] = './uploads/';
				$config2['allowed_types'] = 'jpg|png|doc|docx|pdf|xls|xlsx|rtf|txt|rar|zip';
				$config2['encrypt_name'] = TRUE;
				$config2['max_size']  = '50000';
				$this->upload->initialize($config2); 
				$this->upload->do_upload("certificates"); 
				$file_data2 = $this->upload->data(); 
				$data['certificates'] = $file_data2['file_name'];
			}
			if ($id == NULL) $data['timestamp'] = time();
			$this->clients_m->save($data, $id);
			redirect('clients');

		}
		
		$this->data['subview'] = 'admin/clients/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function _unique_client ($str)
	{		
		$fl_num = $this->input->post('file_num');
		if ($fl_num) {
			$erarray = array('file_num' => $fl_num, 'branch' => $this->input->post('branch'));
			$this->db->where($erarray);
			$user = $this->clients_m->get();
			
			if (!is_null($user)) {
				$this->form_validation->set_message('_unique_client', '%s should be unique');
				return FALSE;
			}
			return TRUE;
		} else return TRUE; 
		
	}


	public function _num_erformat ($str)
	{		

		if (strlen($str) != 9) {
			$this->form_validation->set_message('_num_erformat', 'File number should be like this format 000/00/00');
			return FALSE;
		}
		
		return TRUE;
	}



	

	public function autocmpt ()
	{
		$data = array();
		$srch_array = array();

		switch ($this->session->userdata('admin')) {
			case 2:
				$srch_array['branch'] = $this->session->userdata('branch');
				break;
			case 3:
				$srch_array['made_by'] = $this->session->userdata('id');
				break;
		}

		if($this->input->get('type') == 'lastname'){
			$srch_array = array('last_name' => $this->input->get('last_name'));
			$result = $this->clients_m->get_search($srch_array);
			foreach ($result as $key ) {
				array_push($data, $key->last_name);	
			}	
		} else if($this->input->get('type') == 'file_num') {
			$srch_array = array('file_num' => $this->input->get('file_num'));
			$result = $this->clients_m->get_search($srch_array);
			foreach ($result as $key ) {
				array_push($data, $key->file_num);	
			}
		} else if($this->input->get('type') == 'phone') {
			$srch_array = array('phone' => $this->input->get('phone'));	
			$result = $this->clients_m->get_search($srch_array);
			foreach ($result as $key ) {
				array_push($data, $key->phone);	
			}
		}
		echo json_encode($data);
	}

	public function search ($id = 1)
	{
		$wherearr = array();

		if ($this->input->post('c_lname') != '') {
			$wherearr['last_name'] = $this->input->post('c_lname');
		}
		if ($this->input->post('c_file_num') != '') {
			$wherearr['file_num'] = $this->input->post('c_file_num');
		}
		if ($this->input->post('c_phone') != '') {
			$wherearr['phone'] = $this->input->post('c_phone');
		}

        $this->data['clients'] = $this->clients_m->get_search($wherearr);

		$this->load->view('admin/ajax_pages/srch_client', $this->data);
	}


	public function email_clients_list ()
	{


		$this->data['status'][''] = 'Payments';
		$this->data['status']['0'] = 'Not Paid';
	 	$this->data['status']["1"] = "Paid Advance";
	 	$this->data['status']["2"] = "Paid";

	 	$this->data['registered_from'][''] = 'Registered from';
	 	$this->data['registered_from']["1"] = "Phone";
	 	$this->data['registered_from']["2"] = "Office";

	 	$this->data['registered_type'][''] = '';
	 	$this->data['registered_type']["1"] = "Booked";
	 	$this->data['registered_type']["2"] = "Inquiries";
	 	$this->data['registered_type']["3"] = "Canselled";

	 	$this->data['allbranches'][''] = 'All branches';
	 	foreach ($this->branches_m->get_where(array('active' => 1)) as $key => $value) {
			 		 $this->data['allbranches'][$value->id] = $value->name;
		}


		$c_start = $c_ends = false;
		$erwhere = array();
		switch ($this->session->userdata('admin')) {
			case 1:
					if ($_POST['branch'] != '')  $erwhere['branch'] = $_POST['branch'];
					if ($_POST['usrs'] != '') $erwhere['made_by'] = $_POST['usrs'];
					if ($_POST['registered_type'] != '') $erwhere['registered_type'] = $_POST['registered_type'];
					if ($_POST['active'] != '') $erwhere['active'] = $_POST['active'];
					if ($_POST['country'] != '') $erwhere['c_country_id'] = $_POST['country'];
					if ($_POST['city'] != '') $erwhere['c_city_id'] = $_POST['city'];
					if ($_POST['school'] != '') $erwhere['c_school_id'] = $_POST['school'];
					if ($_POST['c_start'] != 'Start') $c_start = $_POST['c_start'];
					if ($_POST['c_ends'] != 'End') $c_ends = $_POST['c_ends'];					
				break;
			case 2:
					$erwhere['branch'] = $this->session->userdata('branch');
					if ($_POST['usrs']) $erwhere['made_by'] = $_POST['usrs'];
					if ($_POST['registered_type']) $erwhere['registered_type'] = $_POST['registered_type'];
					if ($_POST['active']) $erwhere['active'] = $_POST['active'];
					if ($_POST['country']) $erwhere['c_country_id'] = $_POST['country'];
					if ($_POST['city']) $erwhere['c_city_id'] = $_POST['city'];
					if ($_POST['school']) $erwhere['c_school_id'] = $_POST['school'];
					if ($_POST['c_start']) $c_start = $_POST['c_start'];
					if ($_POST['c_ends']) $c_ends = $_POST['c_ends'];		
				break;
			case 3:
					$erwhere['made_by'] = $this->session->userdata('id');
					if ($_POST['registered_type']) $erwhere['registered_type'] = $_POST['registered_type'];
					if ($_POST['active']) $erwhere['active'] = $_POST['active'];
					if ($_POST['country']) $erwhere['c_country_id'] = $_POST['country'];
					if ($_POST['city']) $erwhere['c_city_id'] = $_POST['city'];
					if ($_POST['school']) $erwhere['c_school_id'] = $_POST['school'];
					if ($_POST['c_start']) $c_start = $_POST['c_start'];
					if ($_POST['c_ends']) $c_ends = $_POST['c_ends'];	
				break;
			default:
				redirect('fees_calculator');
				break;
		}

		$toemail = $_POST['toemail'];
		$this->data['subject'] = $_POST['subject'];
        $this->data['erclients'] = $this->clients_m->print_get_llients('timestamp,file_num,first_name,registered_type,last_name,branch,email,country,made_by,active',$erwhere);


        $body = $this->load->view('admin/clients/email_list', $this->data,true);


       	$account_info = $this->user_m->get_ovrlsldrsmc("name,email", array("id"=>$this->session->userdata('id')));  
        $to=$toemail;
        $subject=$this->data['subject'];
        $body= $body;
        $from = $account_info->email;
        $headers = "From: " . strip_tags($from) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to,$subject,$body,$headers);
        echo 'yes';


	}

	public function submissst_send_emails ()
	{

					$body = '<div style="text-align:center"> <img  src="'. $this->config->item('base_url2').'img/'.$this->data['settings']->logo.'" style="width:150px;"></div><h3 style="text-align:center">'.$subject.'</h3>'.$_POST['body'];
					echo $body;
}
	public function submit_send_emails ()
	{

		$account_info = $this->user_m->get_ovrlsldrsmc("name,email", array("id"=>$this->session->userdata('id')));  
		if (isset($_POST['sndem'])) {
			
				 foreach ($_POST['sndem'] as $key ) {
			        $to=$key;
					$subject = $_POST['subject'];
					$body = '<div style="text-align:center"> <img  src="'. $this->config->item('base_url2').'img/'.$this->data['settings']->logo.'" style="width:150px;"></div><h3 style="text-align:center">'.$subject.'</h3>'.$_POST['body'];
			        $from = $account_info->email;
			        $headers = "From: " . strip_tags($from) . "\r\n";
			        $headers .= "MIME-Version: 1.0\r\n";
			        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			        mail($to,$subject,$body,$headers);
		        }

			echo "yes";
		}  else
		{
				$c_start = $c_ends = false;
				$erwhere = array();
				switch ($this->session->userdata('admin')) {
					case 1:
							if ($_POST['branch'] != '')  $erwhere['branch'] = $_POST['branch'];
							if ($_POST['usrs'] != '') $erwhere['made_by'] = $_POST['usrs'];
							if ($_POST['registered_type'] != '') $erwhere['registered_type'] = $_POST['registered_type'];
							if ($_POST['active'] != '') $erwhere['active'] = $_POST['active'];
							if ($_POST['country'] != '') $erwhere['c_country_id'] = $_POST['country'];
							if ($_POST['city'] != '') $erwhere['c_city_id'] = $_POST['city'];
							if ($_POST['school'] != '') $erwhere['c_school_id'] = $_POST['school'];
							if ($_POST['c_start'] != 'Start') $c_start = $_POST['c_start'];
							if ($_POST['c_ends'] != 'End') $c_ends = $_POST['c_ends'];					
						break;
					case 2:
							$erwhere['branch'] = $this->session->userdata('branch');
							if ($_POST['usrs']) $erwhere['made_by'] = $_POST['usrs'];
							if ($_POST['registered_type']) $erwhere['registered_type'] = $_POST['registered_type'];
							if ($_POST['active']) $erwhere['active'] = $_POST['active'];
							if ($_POST['country']) $erwhere['c_country_id'] = $_POST['country'];
							if ($_POST['city']) $erwhere['c_city_id'] = $_POST['city'];
							if ($_POST['school']) $erwhere['c_school_id'] = $_POST['school'];
							if ($_POST['c_start']) $c_start = $_POST['c_start'];
							if ($_POST['c_ends']) $c_ends = $_POST['c_ends'];		
						break;
					case 3:
							$erwhere['made_by'] = $this->session->userdata('id');
							if ($_POST['registered_type']) $erwhere['registered_type'] = $_POST['registered_type'];
							if ($_POST['active']) $erwhere['active'] = $_POST['active'];
							if ($_POST['country']) $erwhere['c_country_id'] = $_POST['country'];
							if ($_POST['city']) $erwhere['c_city_id'] = $_POST['city'];
							if ($_POST['school']) $erwhere['c_school_id'] = $_POST['school'];
							if ($_POST['c_start']) $c_start = $_POST['c_start'];
							if ($_POST['c_ends']) $c_ends = $_POST['c_ends'];	
						break;
					default:
						redirect('fees_calculator');
						break;
				}

				
		        $erclients = $this->clients_m->print_get_llients('email',$erwhere);


		        foreach ($erclients as $key ) {
			        $to=$key->email;
					$subject = $_POST['subject'];
					$body = '<div style="text-align:center"> <img  src="'. $this->config->item('base_url2').'img/'.$this->data['settings']->logo.'" style="width:150px;"></div><h3 style="text-align:center">'.$subject.'</h3>'.$_POST['body'];
			        $from = $account_info->email;
			        $headers = "From: " . strip_tags($from) . "\r\n";
			        $headers .= "MIME-Version: 1.0\r\n";
			        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			        mail($to,$subject,$body,$headers);
		        }

		        echo 'yes';

    	}




	}
	




	public function send_emails ()
	{

		$c_start = $c_ends = false;

		$this->data['countries_all'][''] = '- - Select country - -';
	 	foreach ($this->countries_m->get_records_where('id,name',array('active'=>1)) as $key ){
	        $this->data['countries_all'][$key->id] = $this->libre->country($key->name);
	    }
	    $this->data['cities_all'][''] = '- - Select City - -';
	    foreach ($this->cities_m->get_records_where('id,name',array('active'=>1)) as $key ){
	        $this->data['cities_all'][$key->id] = $key->name;
	    }
	 	$this->data['centers_all'][''] = '- - Select Centre - -';
	 	foreach ($this->schools_m->get_records_where('id,name',array('active'=>1)) as $key ){
	        $this->data['centers_all'][$key->id] = $key->name;
	    }
	  //   $this->data['countries_all'][''] = '- - Select country - -';
	 	// foreach ($this->countries_m->get_records_where('id,name',array('active'=>1)) as $key ){
	  //       $this->data['countries_all'][$key->id] = $this->libre->country($key->name);
	  //   }

		$this->_array_hlps();

		$erwhere = array();

		switch ($this->session->userdata('admin')) {
			case 1:
				$this->data['users_all'][''] = 'All users';
				foreach ($this->user_m->get_records_where('id,name') as $key ){
			        $this->data['users_all'][$key->id] =   $key->name;
			    }
			    $this->data['allbranches'][''] = 'All branches';
			    foreach ($this->branches_m->get_where(array('active' => 1)) as $key => $value) {
			 		 $this->data['allbranches'][$value->id] = $value->name;
			 	}


			 	// search
			 	if ($this->input->get('search_query') !== FALSE) {
					if ($_GET['branch'] != '')  $erwhere['branch'] = $_GET['branch'];
					if ($_GET['usrs'] != '') $erwhere['made_by'] = $_GET['usrs'];
					if ($_GET['registered_type'] != '') $erwhere['registered_type'] = $_GET['registered_type'];
					if ($_GET['active'] != '') $erwhere['active'] = $_GET['active'];
					if ($_GET['country'] != '') $erwhere['c_country_id'] = $_GET['country'];
					if ($_GET['city'] != '') $erwhere['c_city_id'] = $_GET['city'];
					if ($_GET['school'] != '') $erwhere['c_school_id'] = $_GET['school'];
					if ($_GET['c_start'] != 'Start') $erwhere['c_start'] = $_GET['c_start'];
					if ($_GET['c_ends'] != 'End') $erwhere['c_ends'] = $_GET['c_ends'];					
				} 

				break;
			case 2:
				$this->data['users_all'][''] = 'Users';
				foreach ($this->user_m->get_records_where('id,name',array('branch' => $this->session->userdata('branch'))) as $key ){
			        $this->data['users_all'][$key->id] =   $key->name;
			    }
				$erwhere['branch'] = $this->session->userdata('branch');

				// search
			 	if ($this->input->get('search_query') !== FALSE) {
					if ($_GET['usrs']) $erwhere['made_by'] = $_GET['usrs'];
					if ($_GET['registered_type']) $erwhere['registered_type'] = $_GET['registered_type'];
					if ($_GET['active']) $erwhere['active'] = $_GET['active'];
					if ($_GET['country']) $erwhere['c_country_id'] = $_GET['country'];
					if ($_GET['city']) $erwhere['c_city_id'] = $_GET['city'];
					if ($_GET['school']) $erwhere['c_school_id'] = $_GET['school'];
					if ($_GET['c_start'] != 'Start') $erwhere['c_start'] = $_GET['c_start'];
					if ($_GET['c_ends'] != 'End') $erwhere['c_ends'] = $_GET['c_ends'];		
				} 
				break;
			case 3:
				$erwhere['made_by'] = $this->session->userdata('id');
				// search
			 	if ($this->input->get('search_query') !== FALSE) {
					if ($_GET['registered_type']) $erwhere['registered_type'] = $_GET['registered_type'];
					if ($_GET['active']) $erwhere['active'] = $_GET['active'];
					if ($_GET['country']) $erwhere['c_country_id'] = $_GET['country'];
					if ($_GET['city']) $erwhere['c_city_id'] = $_GET['city'];
					if ($_GET['school']) $erwhere['c_school_id'] = $_GET['school'];
					if ($_GET['c_start'] != 'Start') $erwhere['c_start'] = $_GET['c_start'];
					if ($_GET['c_ends'] != 'End') $erwhere['c_ends'] = $_GET['c_ends'];		
					
				} 
				break;
			default:
				redirect('fees_calculator');
				break;
		}


		$paginate_info = paginate_it('clients/send_emails/', 20, $this->clients_m->coulients('clients',$erwhere), 3, ''); 
        $this->data['clients'] = $this->clients_m->get_llients($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/clients/send_email';
		$this->load->view('admin/_layout_main', $this->data);
	}





	public function print_clients ()
	{

		$c_start = $c_ends = false;

		$this->data['countries_all'][''] = '- - Select country - -';
	 	foreach ($this->countries_m->get_records_where('id,name',array('active'=>1)) as $key ){
	        $this->data['countries_all'][$key->id] = $this->libre->country($key->name);
	    }
	    $this->data['cities_all'][''] = '- - Select City - -';
	    foreach ($this->cities_m->get_records_where('id,name',array('active'=>1)) as $key ){
	        $this->data['cities_all'][$key->id] = $key->name;
	    }
	 	$this->data['centers_all'][''] = '- - Select Centre - -';
	 	foreach ($this->schools_m->get_records_where('id,name',array('active'=>1)) as $key ){
	        $this->data['centers_all'][$key->id] = $key->name;
	    }
	  //   $this->data['countries_all'][''] = '- - Select country - -';
	 	// foreach ($this->countries_m->get_records_where('id,name',array('active'=>1)) as $key ){
	  //       $this->data['countries_all'][$key->id] = $this->libre->country($key->name);
	  //   }

		$this->_array_hlps();

		$erwhere = array();

		switch ($this->session->userdata('admin')) {
			case 1:
				$this->data['users_all'][''] = 'All users';
				foreach ($this->user_m->get_records_where('id,name') as $key ){
			        $this->data['users_all'][$key->id] =   $key->name;
			    }
			    $this->data['allbranches'][''] = 'All branches';
			    foreach ($this->branches_m->get_where(array('active' => 1)) as $key => $value) {
			 		 $this->data['allbranches'][$value->id] = $value->name;
			 	}


			 	// search
			 	if ($this->input->get('search_query') !== FALSE) {
					if ($_GET['branch'] != '')  $erwhere['branch'] = $_GET['branch'];
					if ($_GET['usrs'] != '') $erwhere['made_by'] = $_GET['usrs'];
					if ($_GET['registered_type'] != '') $erwhere['registered_type'] = $_GET['registered_type'];
					if ($_GET['active'] != '') $erwhere['active'] = $_GET['active'];
					if ($_GET['country'] != '') $erwhere['c_country_id'] = $_GET['country'];
					if ($_GET['city'] != '') $erwhere['c_city_id'] = $_GET['city'];
					if ($_GET['school'] != '') $erwhere['c_school_id'] = $_GET['school'];
					if ($_GET['c_start'] != 'Start') $erwhere['c_start'] = $_GET['c_start'];
					if ($_GET['c_ends'] != 'End') $erwhere['c_ends'] = $_GET['c_ends'];						
				} 

				break;
			case 2:
				$this->data['users_all'][''] = 'Users';
				foreach ($this->user_m->get_records_where('id,name',array('branch' => $this->session->userdata('branch'))) as $key ){
			        $this->data['users_all'][$key->id] =   $key->name;
			    }
				$erwhere['branch'] = $this->session->userdata('branch');

				// search
			 	if ($this->input->get('search_query') !== FALSE) {
					if ($_GET['usrs']) $erwhere['made_by'] = $_GET['usrs'];
					if ($_GET['registered_type']) $erwhere['registered_type'] = $_GET['registered_type'];
					if ($_GET['active']) $erwhere['active'] = $_GET['active'];
					if ($_GET['country']) $erwhere['c_country_id'] = $_GET['country'];
					if ($_GET['city']) $erwhere['c_city_id'] = $_GET['city'];
					if ($_GET['school']) $erwhere['c_school_id'] = $_GET['school'];
					if ($_GET['c_start'] != 'Start') $erwhere['c_start'] = $_GET['c_start'];
					if ($_GET['c_ends'] != 'End') $erwhere['c_ends'] = $_GET['c_ends'];	
				} 
				break;
			case 3:
				$erwhere['made_by'] = $this->session->userdata('id');
				// search
			 	if ($this->input->get('search_query') !== FALSE) {
					if ($_GET['registered_type']) $erwhere['registered_type'] = $_GET['registered_type'];
					if ($_GET['active']) $erwhere['active'] = $_GET['active'];
					if ($_GET['country']) $erwhere['c_country_id'] = $_GET['country'];
					if ($_GET['city']) $erwhere['c_city_id'] = $_GET['city'];
					if ($_GET['school']) $erwhere['c_school_id'] = $_GET['school'];
					if ($_GET['c_start'] != 'Start') $erwhere['c_start'] = $_GET['c_start'];
					if ($_GET['c_ends'] != 'End') $erwhere['c_ends'] = $_GET['c_ends'];		
					
				} 
				break;
			default:
				redirect('fees_calculator');
				break;
		}


		$paginate_info = paginate_it('clients/print_clients/', 20, $this->clients_m->coulients('clients',$erwhere), 3, ''); 
        $this->data['clients'] = $this->clients_m->get_llients($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/clients/print';
		$this->load->view('admin/_layout_main', $this->data);
	}


	public function _array_hlps () 
	{
		$this->data['status'][''] = 'Payments';
		$this->data['status']['0'] = 'Not Paid';
	 	$this->data['status']["1"] = "Paid Advance";
	 	$this->data['status']["2"] = "Paid";

	 	$this->data['registered_from'][''] = 'Registered from';
	 	$this->data['registered_from']["1"] = "Phone";
	 	$this->data['registered_from']["2"] = "Office";

	 	$this->data['registered_type'][''] = 'Type';
	 	$this->data['registered_type']["1"] = "Booked";
	 	$this->data['registered_type']["2"] = "Inquiries";
	 	$this->data['registered_type']["3"] = "Canselled";

	 	$this->data['genders'][''] = ' - - Gender - - ';
	 	$this->data['genders']['1'] = 'Male';
	 	$this->data['genders']["2"] = "Female";

	 	$this->data['visa_types'][''] = ' - - Visa Type - - ';
	 	$this->data['visa_types']["1"] = "Visa";
	 	$this->data['visa_types']["2"] = "MasterCard";
	 	$this->data['visa_types']["3"] = "Discover";
	 	$this->data['visa_types']["4"] = "AmEx";
	}



	public function _weekssellect()
	{
		$data['weeks_all'][''] = '- - Please Select - -';
		$data['weeks_all']['1'] = '1 week';
		$data['weeks_all']['2'] = '2 weeks';
		$data['weeks_all']['3'] = '3 weeks';
		$data['weeks_all']['4'] = '4 weeks';
		$data['weeks_all']['5'] = '5 weeks';
		$data['weeks_all']['6'] = '6 weeks';
		$data['weeks_all']['7'] = '7 weeks';
		$data['weeks_all']['8'] = '8 weeks';
		$data['weeks_all']['9'] = '9 weeks';
		$data['weeks_all']['10'] = '10 weeks';
		$data['weeks_all']['11'] = '11 weeks';
		$data['weeks_all']['12'] = '12 weeks';
		$data['weeks_all']['13'] = '13 weeks';
		$data['weeks_all']['14'] = '14 weeks';
		$data['weeks_all']['15'] = '15 weeks';
		$data['weeks_all']['16'] = '16 weeks';
		$data['weeks_all']['17'] = '17 weeks';
		$data['weeks_all']['18'] = '18 weeks';
		$data['weeks_all']['19'] = '19 weeks';
		$data['weeks_all']['20'] = '20 weeks';
		$data['weeks_all']['21'] = '21 weeks';
		$data['weeks_all']['22'] = '22 weeks';
		$data['weeks_all']['23'] = '23 weeks';
		$data['weeks_all']['24'] = '24 weeks';
		$data['weeks_all']['25'] = '25 weeks';
		$data['weeks_all']['26'] = '26 weeks';
		$data['weeks_all']['27'] = '27 weeks';
		$data['weeks_all']['28'] = '28 weeks';
		$data['weeks_all']['29'] = '29 weeks';
		$data['weeks_all']['30'] = '30 weeks';
		$data['weeks_all']['31'] = '31 weeks';
		$data['weeks_all']['32'] = '32 weeks';
		$data['weeks_all']['33'] = '33 weeks';
		$data['weeks_all']['34'] = '34 weeks';
		$data['weeks_all']['35'] = '35 weeks';
		$data['weeks_all']['36'] = '36 weeks';
		$data['weeks_all']['37'] = '37 weeks';
		$data['weeks_all']['38'] = '38 weeks';
		$data['weeks_all']['39'] = '39 weeks';
		$data['weeks_all']['40'] = '40 weeks';
		$data['weeks_all']['41'] = '41 weeks';
		$data['weeks_all']['42'] = '42 weeks';
		$data['weeks_all']['43'] = '43 weeks';
		$data['weeks_all']['44'] = '44 weeks';
		$data['weeks_all']['45'] = '45 weeks';
		$data['weeks_all']['46'] = '46 weeks';
		$data['weeks_all']['47'] = '47 weeks';
		$data['weeks_all']['48'] = '48 weeks';

		return $data['weeks_all'];
	}








	public function delete ($id)
	{
		$this->clients_m->delete($id);
		redirect('clients');
	}

}