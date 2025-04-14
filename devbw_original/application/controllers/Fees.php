<?php
class Fees extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$this->data['countries_all'][''] = '- - Select country - -';
		foreach ($this->countries_m->get_records_where('id,name', array('active' => 1)) as $key) {
			$this->data['countries_all'][$key->id] = $this->libre->country($key->name);
		}

		$this->data['regions_all'][''] = 'All regions';
		foreach ($this->regions_m->get_records_where('id,name', array()) as $key) {
			$this->data['regions_all'][$key->id] = $key->name;
		}

		$this->data['cities_all'][''] = '- - Select City - -';
		$this->data['centers_all'][''] = '- - Select Centre - -';
		$this->data['courses_all'][''] = '- - Select Course - -';

		$this->data['courses_addons_all'][''] = '- - Select Course Addons - -';
		$this->data['courses_addons_weeks_all'][''] = '- - Select Weeks - -';
		$this->data['courses_family_all'][''] = '- - Select Course Family - -';
		$this->data['courses_family_weeks_all'][''] = '- - Select Weeks - -';
		$this->data['courses_exam_all'][''] = '- - Select Exam Preparation - -';
		$this->data['courses_exam_dates_all'][''] = '- - Select Start Date - -';
		$this->data['courses_exam_weeks_all'][''] = '- - Select Weeks - -';

		$this->data['courses_professional_all'][''] = '- - Select Professional Course - -';
		$this->data['courses_professional_dates_all'][''] = '- - Select Start Date - -';
		

		$this->data['accommodation_all'][''] = '- - No Accommodation Required- -';
		$this->data['airports_arr_all'][''] = '- - Not Required - -';
		$this->data['airports_dep_all'][''] = '- - Not Required - -';
		$this->data['weeks_all'] = $this->_weekssellect();
		$this->data['weeks_one'] = array();

		$this->data['medical_insurance'][''] = 'I do not require Study insurance';
		$this->data['medical_insurance']['1'] = 'I would like Study Care insurance';

		$this->data['courier_fee'][''] = 'No';
		$this->data['courier_fee']['1'] = 'Yes';


		$this->data['registered_from']['0'] = 'Registered from';
		$this->data['registered_from']["1"] = "Phone";
		$this->data['registered_from']["2"] = "Office";

		$this->data['registered_type'][''] = 'Registered type';
		$this->data['registered_type']["1"] = "Booked";
		$this->data['registered_type']["2"] = "Inquiries";
		$this->data['registered_type']["3"] = "Canselled";
		// client info
		$this->data['status']['0'] = 'Not Paid';
		$this->data['status']["1"] = "Paid Advance";
		$this->data['status']["2"] = "Paid";

		$this->data['genders'][''] = ' - - Gender - - ';
		$this->data['genders']['1'] = 'Male';
		$this->data['genders']["2"] = "Female";

		$this->data['visa_types'][''] = ' - - Visa Type - - ';
		$this->data['visa_types']["1"] = "Visa";
		$this->data['visa_types']["2"] = "MasterCard";
		$this->data['visa_types']["3"] = "Discover";
		$this->data['visa_types']["4"] = "AmEx";

		$this->data['currency_all'][''] = 'Choose Currency';
		foreach ($this->currency_m->get_records_where('id,name') as $key) {
			$this->data['currency_all'][$key->id] =   $key->name;
		}


		$this->data['subview'] = 'admin/fees_calculator/fees_new';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function submit()
	{

		$filteredData = substr($_POST['pdf_get_valclient'], strpos($_POST['pdf_get_valclient'], ",") + 1);
		$unencodedData = base64_decode($filteredData);
		do {
			$imgname = rand(10000000, 99999999);
		} while (file_exists('./uploads/trash_img/' . $imgname . '.png'));
		file_put_contents('./uploads/trash_img/' . $imgname . '.png', $unencodedData);


		$this->load->library('fpdf_gen');
		$this->fpdf->Image(base_url('img/amodi.png'), 10, 0, -220);
		$this->fpdf->SetFont('Arial', 'I', 8);
		$this->fpdf->Text(178, 10, 'Date : ' . date("Y/m/d"));
		$this->fpdf->SetFont('Arial', 'B', 14);
		$this->fpdf->Cell(80);
		$this->fpdf->Cell(30, 5, $this->data['settings']->pdf_title, 0, 0, 'C');
		$this->fpdf->Ln(20);
		$this->fpdf->Image(base_url('uploads/trash_img/' . $imgname . '.png'), 10, 30, -145);
		$this->fpdf->SetY(276);
		$this->fpdf->SetFont('Arial', 'I', 8);
		$this->fpdf->Cell(0, 0, 'Page ' . $this->fpdf->PageNo(), 0, 0, 'C');


		$this->fpdf->Output('F', './uploads/pdf/' . $imgname . '.pdf');
		$pdf_file_name = $imgname . '.pdf';

		unlink('./uploads/trash_img/' . $imgname . '.png');

		$this->load->library('upload');



		$rules = $this->clients_m->rules;
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == TRUE) {

			$data = $this->clients_m->array_from_post(array(
				'first_name',
				'last_name',
				'gender',
				'email',
				'file_num',
				'address',
				'city',
				'country',
				'course_price',
				'registered_from',
				'registered_type',
				'phone',
				'heard_about_us',
				'visa_type',
				'passport',
				'certificates',
				'birthday',
				'post_code',
				'active',
				'c_country_id',
				'c_city_id',
				'c_school_id',
				'course_id'
			));


			if ($_POST['slc_couse_weeks']) $data['c_couse_weeks'] = $_POST['slc_couse_weeks'];
			elseif ($_POST['slc_couse_weeks2']) $data['c_couse_weeks'] = $_POST['slc_couse_weeks2'];

			if ($_POST['date']) $data['c_start'] = $_POST['date'];
			elseif ($_POST['date2']) $data['c_start'] = $_POST['date2'];

			$weekshelper = '+' . $data['c_couse_weeks'] . ' week';
			$data['c_ends'] = date('Y-m-d', strtotime($weekshelper, strtotime($data['c_start'])));



			// echo '<br> date2 ====> '.$data['date2'];
			// echo '<br> slc_couse_weeks ====> '.$data['slc_couse_weeks'];
			// echo '<br> date ====> '.$data['date'];
			// echo '<br> c_start ====> '.$data['c_start'];
			// echo '<br> slc_couse_weeks2 ====> '.$data['slc_couse_weeks2'];

			// echo "<pre>";
			// print_r($_POST);
			// exit();

			$data['timestamp'] = time();
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

			$data['pdf_course'] = $pdf_file_name;
			$client_idww = $this->clients_m->save($data);

			if ($_POST['he_pay'] && $_POST['currency_id']) {
				$data_pay['client_id'] = $client_idww;
				$data_pay['price'] = $_POST['he_pay'];
				$data_pay['currency_id'] = $_POST['currency_id'];
				$data_pay['made_by'] = $this->session->userdata('id');
				$this->payments_m->save($data_pay);
			}

			if ($_POST['note']) {
				$data_notes['made_by'] = $this->session->userdata('id');
				$data_notes['note'] = $_POST['note'];
				$data_notes['client_id'] = $client_idww;
				$this->notes_m->save($data_notes);
			}
		}

		redirect('fees_calculator/index');
	}

	public function _unique_client($str)
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

	public function _num_erformat($str)
	{

		if (strlen($str) != 9) {
			$this->form_validation->set_message('_num_erformat', 'File number should be like this format 000/00/00');
			return FALSE;
		}

		return TRUE;
	}

	public function get_pdf()
	{

		$filteredData = substr($_POST['pdf_get_val'], strpos($_POST['pdf_get_val'], ",") + 1);
		$unencodedData = base64_decode($filteredData);
		do {
			$imgname = rand(10000000, 99999999);
		} while (file_exists('./uploads/trash_img/' . $imgname . '.png'));
		file_put_contents('./uploads/trash_img/' . $imgname . '.png', $unencodedData);

		$this->load->library('fpdf_gen');
		$this->fpdf->Image(base_url('img/amodi.png'), 10, 0, -220);
		$this->fpdf->SetFont('Arial', 'I', 8);
		$this->fpdf->Text(178, 10, 'Date : ' . date("Y/m/d"));
		$this->fpdf->SetFont('Arial', 'B', 14);
		$this->fpdf->Cell(80);
		$this->fpdf->Cell(30, 5, $this->data['settings']->pdf_title, 0, 0, 'C');
		$this->fpdf->Ln(20);
		$this->fpdf->Image(base_url('uploads/trash_img/' . $imgname . '.png'), 10, 30, 191);
		$this->fpdf->SetY(276);
		$this->fpdf->SetFont('Arial', 'I', 8);
		$this->fpdf->Cell(0, 0, 'Page ' . $this->fpdf->PageNo(), 0, 0, 'C');

		echo $this->fpdf->Output('Eurocentres_qoutastion.pdf', 'I'); 	  // show pdf on browser
		//	echo $this->fpdf->Output('hello_world.pdf','D');      // download pdf
		//	$this->fpdf->Output('F','./pdf/'.$imgname.'.pdf');    // save pdf to server
		//	$pdf_file_name = $imgname.'.pdf';


		unlink('./uploads/trash_img/' . $imgname . '.png');

		/*		echo "<pre>";
                print_r($_POST);*/
	}






	public function get_quote()
	{
		$this->data['info'] = array();
		$this->load->view('admin/fees_calculator/quote.php', $this->data);
	}


	public function get_pdf22()
	{

		$this->data['settings']->description;



		echo "<pre";
		print_r($this->data['settings']);
	}

	public function get_pdf2ssss2()
	{

		$filteredData = substr($_POST['pdf_get_val'], strpos($_POST['pdf_get_val'], ",") + 1);
		$unencodedData = base64_decode($filteredData);
		do {
			$imgname = rand(10000000, 99999999);
		} while (file_exists('./uploads/trash_img/' . $imgname . '.png'));
		file_put_contents('./uploads/trash_img/' . $imgname . '.png', $unencodedData);

		$this->load->library('Fpdf_gen');
		$this->fpdf->SetFont('Arial', 'B', 16);

		$this->fpdf->Image(base_url('img/amodi.png'), 10, 10, -300);


		$this->fpdf->Image(base_url('uploads/trash_img/' . $imgname . '.png'), 10, 10, -300);

		$this->fpdf->Cell(40, 10, 'Amoudi Qoutastion');

		//	echo $this->fpdf->Output('hello_world.pdf','I'); 	  show pdf on browser
		//	echo $this->fpdf->Output('hello_world.pdf','D');      download pdf
		//	$this->fpdf->Output('F','./pdf/'.$imgname.'.pdf');    save pdf to server
		//	$pdf_file_name = $imgname.'.pdf';

	}

	public function fees_get_city()
	{
		$country_id = $this->input->get('country_id');
		$this->data['cities'] = '<select name"slc_city" class="form-control" onchange="city_onchange(this);" id="slc_city"><option value="">Choose City</option>';
		foreach ($this->cities_m->get_records_where('id,name', array('country_id' => $country_id, 'active' => 1)) as $key) {
			$this->data['cities'] .= '<option value="' . $key->id . '">' . $key->name . '</option>';
		}
		$this->data['cities'] .= '</select>';

		$data2 = array(
			'cities'       => $this->data['cities']
		);
		echo json_encode($data2);
	}

	public function fees_get_centre()
	{
		$city_id = $this->input->get('city_id');
		$this->data['centres'] = '<select name"slc_city" class="form-control" onchange="centre_onchange(this);" id="slc_centre"><option value="">Choose Centre</option>';
		foreach ($this->schools_m->get_records_where('id,name', array('city_id' => $city_id, 'active' => 1)) as $key) {
			$this->data['centres'] .= '<option value="' . $key->id . '">' . $key->name . '</option>';
		}
		$this->data['centres'] .= '</select>';

		$data2 = array(
			'centres'       => $this->data['centres']
		);
		echo json_encode($data2);
	}

	public function fees_get_center()
	{

		$centre_id = $this->input->get('centre_id');

		// school info 
		$this->data['school_info'] = $this->schools_m->get_records_where('*', array('id' => $centre_id), TRUE);
		$this->data['currency_info'] = $this->currency_m->get_records_where(
			'*',
			array('active' => 1, 'id' => $this->data['school_info']->currency_id),
			TRUE
		);

		// airports
		$this->data['airports_arr'] = '<select name"slc_course" class="form-control" onchange="airport_arr_onchange(this);" id="slc_airport_arr"><option value="">Not Required</option>';
		$this->data['airports_dep'] = '<select name"slc_course" class="form-control" onchange="airport_dep_onchange(this);" id="slc_airport_dep"><option value="">Not Required</option>';
		$this->data['airports'] = "";
		foreach ($this->airports_m->get_records_where('id,name', array('school_id' => $centre_id, 'active' => 1)) as $key) {
			$this->data['airports'] .= '<option value="' . $key->id . '">' . $key->name . '</option>';
		}
		$this->data['airports'] .= '</select>';

		$this->data['airports_arr'] .= $this->data['airports'];
		$this->data['airports_dep'] .= $this->data['airports'];

		// accommodation
		$this->data['accommodation'] = '<select name"slc_course" class="form-control" onchange="accommodation_onchange(this);" id="slc_accommodation"><option value="">Not Required</option>';
		foreach ($this->accommodation_m->get_records_where('id,name', array('school_id' => $centre_id, 'active' => 1)) as $key) {
			$this->data['accommodation'] .= '<option value="' . $key->id . '">' . $key->name . '</option>';
		}
		$this->data['accommodation'] .= '</select>';

		// courses
		$this->data['courses'] = '<select name"slc_course" class="form-control" onchange="course_onchange(this);" id="slc_course"><option value="">Choose Course</option>';
		foreach ($this->courses_m->get_records_where('id,name', array('school_id' => $centre_id, 'active' => 1)) as $key) {
			$this->data['courses'] .= '<option value="' . $key->id . '">' . $key->name . '</option>';
		}
		$this->data['courses'] .= '</select>';

		
		// courses addons
		$this->data['courses_addons'] = '<select name"slc_courses_addons" class="form-control" onchange="courses_addons_onchange(this);" id="slc_courses_addons"><option value="">Choose Course</option>';
		foreach ($this->courses_addons_m->get_records_where('id,name', array('school_id' => $centre_id, 'active' => 1)) as $key) {
			$this->data['courses_addons'] .= '<option value="' . $key->id . '">' . $key->name . '</option>';
		}
		$this->data['courses_addons'] .= '</select>';

		// courses family
		$this->data['courses_family'] = '<select name"slc_courses_family" class="form-control" onchange="courses_family_onchange(this);" id="slc_courses_family"><option value="">Choose Course</option>';
		foreach ($this->courses_family_m->get_records_where('id,name', array('school_id' => $centre_id, 'active' => 1)) as $key) {
			$this->data['courses_family'] .= '<option value="' . $key->id . '">' . $key->name . '</option>';
		}
		$this->data['courses_family'] .= '</select>';

		// courses exam
		$this->data['courses_exam'] = '<select name"slc_courses_exam" class="form-control" onchange="courses_exam_onchange(this);" id="courses_exam"><option value="">Choose Exam</option>';
		foreach ($this->courses_exam_m->get_records_where('id,name', array('school_id' => $centre_id, 'active' => 1)) as $key) {
			$this->data['courses_exam'] .= '<option value="' . $key->id . '">' . $key->name . '</option>';
		}
		$this->data['courses_exam'] .= '</select>';

		// courses professional
		$this->data['courses_professional'] = '<select name"slc_courses_professional" class="form-control" onchange="course_professional_onchange(this);" id="slc_course_professional"><option value="">Choose Professional</option>';
		foreach ($this->courses_professional_m->get_records_where('id,name', array('school_id' => $centre_id, 'active' => 1)) as $key) {
			$this->data['courses_professional'] .= '<option value="' . $key->id . '">' . $key->name . '</option>';
		}
		$this->data['courses_professional'] .= '</select>';
		

		$data2 = array(
			'courses'       => $this->data['courses'],
			'courses_addons'=> $this->data['courses_addons'],
			'courses_family'=> $this->data['courses_family'],
			'courses_exam'  => $this->data['courses_exam'],
			'courses_professional'  => $this->data['courses_professional'],
			'accommodation' => $this->data['accommodation'],
			'airports_arr'  => $this->data['airports_arr'],
			'airports_dep'  => $this->data['airports_dep'],
			'school_info'	=> $this->data['school_info'],
			'currency_info' => $this->data['currency_info']
		);
		echo json_encode($data2);
	}

	public function fees_get_course_info()
	{

		$course_id = $this->input->get('course_id');
		$region_id = $this->input->get('region_id');

		// school info 
		$this->data['course_info'] = $this->courses_m->get_records_where('*', array('id' => $course_id), TRUE);

		$this->data['course_price_info'] = $this->prices_m->get_records_whereord5('*', array('course_id' => $course_id));

		$course_fixed_discounts = $this->fixed_discount_m->get_records_where('*', array('course_id' => $course_id, 'region_id' => $region_id, 'active' => 1), TRUE);
		if (empty($course_fixed_discounts)) {
			$course_fixed_discounts['sum_course'] = '';
			$course_fixed_discounts['text_course'] = '';
			$course_fixed_discounts['sum_accommo'] = '';
			$course_fixed_discounts['text_accommo'] = '';
		}

		$course_other_discounts = $this->other_discount_m->get_records_where('*', array('course_id' => $course_id, 'region_id' => $region_id, 'active' => 1), TRUE);
		if ($course_other_discounts) {
			$this->data['course_info']->registration_fee_off = $course_other_discounts->registration_fee_off;
			$this->data['course_info']->accommodation_fee_off = $course_other_discounts->accommodation_fee_off;
			$this->data['course_info']->arrival_off = $course_other_discounts->arrival_off;
		} else {
			$this->data['course_info']->registration_fee_off = '';
			$this->data['course_info']->accommodation_fee_off = '';
			$this->data['course_info']->arrival_off = '';
		}


		$data2 = array(
			'course_info'       => $this->data['course_info'],
			'course_fixed_discounts'       => $course_fixed_discounts, // discount
			//    'accommodation' => $this->data['accommodation'], 
			'course_prices' => $this->data['course_price_info']
		);
		echo json_encode($data2);
	}
	
	public function fees_get_course_addons_info()
	{

		$course_addons_id = $this->input->get('course_addons_id');
		$region_id = $this->input->get('region_id');

		// school info 
		$this->data['course_addons_info'] = $this->courses_addons_m->get_records_where('*', array('id' => $course_addons_id), TRUE);


		$data2 = array(
			'course_addons_info'       => $this->data['course_addons_info']
		);

		echo json_encode($data2);
	}
	
	public function fees_get_course_addons_weeks_info()
	{

		$course_addons_id = $this->input->get('course_addons_id');
		$weeks = $this->input->get('weeks');

		$course_addons_info = $this->courses_addons_m->get_records_where('*', array('id' => $course_addons_id), TRUE);
		$datainfo = array(
			'lessons' => '',
            'price' => '',
            'weeks' => '',
            'prices' => '',
		);
		if (!empty($course_addons_info)) {
			$datainfo['weeks'] = $weeks;

			$datainfo['lessons'] = $course_addons_info->lessons;
			$datainfo['price'] = $course_addons_info->price;

			$datainfo['prices'] = ((double) $datainfo['price']) *((int) $datainfo['weeks']);
		}

		echo json_encode($datainfo);
	}
	
	public function fees_get_course_family_info()
	{

		$course_family_id = $this->input->get('course_family_id');
		$region_id = $this->input->get('region_id');
		$course_weeks = $this->input->get('weeks');

		// school info 
		$course_family_info = $this->courses_family_m->get_records_where('*', array('id' => $course_family_id), TRUE);

		$datainfo = array(
			'name' => '',
			'lessons' => '',
			'datefrom' => '',
			'dateto' => '',
			'weeks' => '0',
            'price' => '',
            'prices' => '',
			'notes' => '',
			'course_weeks' => $course_weeks
		);
		if (!empty($course_family_info)) {

			$datainfo['name'] = $course_family_info->name;
			$datainfo['lessons'] = $course_family_info->lessons;
			$datainfo['datefrom'] = $course_family_info->date_from;
			$datainfo['dateto'] = $course_family_info->date_to;
			$datainfo['price'] = $course_family_info->price;
			$datainfo['extra'] = $course_family_info->extra;
			$datainfo['notes'] = $course_family_info->notes;

			$datainfo['prices'] = (((double) $datainfo['price']) + ((int) $datainfo['extra'])) * ((double) $course_weeks);
		}

		echo json_encode($datainfo);
	}
	
	public function fees_get_course_exam_info()
	{

		$course_exam_id = $this->input->get('course_exam_id');
		$region_id = $this->input->get('region_id');
		
		$course_exam_info = $this->courses_exam_m->get_records_where('*', array('id' => $course_exam_id), TRUE);
		$start_dates = explode(',', $course_exam_info->start_dates);

		$courses_exam_dates = '<select name"slc_courses_exam_dates" class="form-control" onchange="course_exam_dates_onchange(this);" id="courses_exam_dates"><option value="">Choose Number of dates</option>';
		foreach ($start_dates as $key) {
			$courses_exam_dates .= '<option value="' . $key . '">' . $key . '</option>';
		}
		$courses_exam_dates .= '</select>';

		$courses_exam_weeks = '<select name"slc_courses_exam_weeks" class="form-control" onchange="course_exam_weeks_onchange(this);" id="courses_exam_weeks"><option value="">Choose Number of Weeks</option>';
		foreach ($this->courses_exam_prices_m->get_records_where('id,duration', array('course_exam_id' => $course_exam_id, 'active' => 1)) as $key) {
			$courses_exam_weeks .= '<option value="' . $key->id . '">' . $key->duration . ' weeks</option>';
		}
		$courses_exam_weeks .= '</select>';

		$datainfo = array();
		$datainfo['courses_exam_dates'] = $courses_exam_dates;
		$datainfo['courses_exam_weeks'] = $courses_exam_weeks;
		$datainfo['name'] = '';
		$datainfo['lessons'] = '';
		$datainfo['start_dates'] = $start_dates;
		if (!empty($course_exam_info)) {
			$datainfo['name'] = $course_exam_info->name;
			$datainfo['lessons'] = $course_exam_info->lessons;
			$datainfo['notes'] = nl2br($course_exam_info->notes);
		}
		echo json_encode($datainfo);
	}

	public function fees_get_course_exam_weeks_info()
	{

		$course_exam_weeks_id = $this->input->get('course_exam_weeks_id');
		$region_id = $this->input->get('region_id');
		$course_exam_id = $this->input->get('course_exam_id');
		
		$course_exam_info = $this->courses_exam_m->get_records_where('*', array('id' => $course_exam_id), TRUE);
		$course_exam_prices_info = $this->courses_exam_prices_m->get_records_where('*', array('id' => $course_exam_weeks_id), TRUE);

		$datainfo = array(
			'name' => '',
			'lessons' => '',
			'notes' => '',
			'price' => '',
			'duration' => '',
		);
		if (!empty($course_exam_info)) {
			$datainfo['name'] = $course_exam_info->name;
			$datainfo['lessons'] = $course_exam_info->lessons;
			$datainfo['notes'] = nl2br($course_exam_info->notes);
		}
		if (!empty($course_exam_prices_info)) {
			$datainfo['price'] = $course_exam_prices_info->price;
			$datainfo['duration'] = $course_exam_prices_info->duration;
		}

		echo json_encode($datainfo);
	}
	
	public function fees_get_course_professional_info()
	{

		$course_professional_id = $this->input->get('course_professional_id');
		$region_id = $this->input->get('region_id');
		
		$course_professional_info = $this->courses_professional_m->get_records_where('*', array('id' => $course_professional_id), TRUE);
		$start_dates = explode(',', $course_professional_info->start_dates);

		$courses_professional_dates = '<select name"slc_courses_professional_dates" class="form-control" onchange="course_professional_onchange(this);" id="courses_professional_dates"><option value="">Choose Number of dates</option>';
		foreach ($start_dates as $key) {
			$courses_professional_dates .= '<option value="' . $key . '">' . $key . '</option>';
		}
		$courses_professional_dates .= '</select>';

		$datainfo = array();
		$datainfo['courses_professional_dates'] = $courses_professional_dates;
		$datainfo['name'] = $course_professional_info->name;
		$datainfo['price'] = $course_professional_info->price;
		$datainfo['weeks'] = $course_professional_info->duration;
		$datainfo['notes'] = $course_professional_info->notes;

		echo json_encode($datainfo);
	}

	public function course_range_price()
	{

		$weeks_num = $this->input->get('weeks_num');
		$course_id = $this->input->get('course_id');
		$region_id = $this->input->get('region_id');


		$this->data['course_all_info'] = $this->courses_m->get_records_where('*', array('id' => $course_id), TRUE);

		$course_info = $this->prices_m->direct_query('SELECT price FROM prices WHERE course_id = ' . $course_id . ' and ' . $weeks_num . ' BETWEEN start AND ends');
		$course_discnt = $this->course_discount_m->direct_query('SELECT discount FROM course_discount WHERE region_id = ' . $region_id . ' and course_id = ' . $course_id . ' and active = 1 and ' . $weeks_num . ' BETWEEN start AND ends');
		if (!empty($course_info)) {
			$course_price = $course_info[0]->price;
		} else {
			$course_price = 0;
		}

		if (!empty($course_discnt)) {
			if ($course_discnt[0]->discount != 0) {
				$course_discount_percent = $course_discnt[0]->discount;
				$waived = ($course_discount_percent / 100) * $course_price;
				//$course_price = $course_price - $waived; 
			}
		} else {
			$course_discount_percent = 0;
			$waived = 0;
		}


		$data2 = array(
			'price'       => $course_price,
			'course_discount_percent'       => $course_discount_percent,
			'course_waived'       => $waived
		);
		echo json_encode($data2);
	}

	public function acco_range_price()
	{

		$weeks_num = $this->input->get('weeks_num');
		$acco_id = $this->input->get('acco_id');
		$accotype = $this->input->get('accotype');

		$course_info = $this->prices_m->direct_query('SELECT price FROM acco_prices WHERE type = ' . $accotype . ' and acco_id = ' . $acco_id . ' and ' . $weeks_num . ' BETWEEN start AND ends');
		$accommodation_info = $this->accommodation_m->get_records_where('*', array('id' => $acco_id), TRUE);

		$course_discnt = $this->accomo_discount_m->direct_query('SELECT discount FROM accomo_discount WHERE acco_id = ' . $acco_id . ' and ' . $weeks_num . ' BETWEEN start AND ends');

		if (!empty($course_info)) {
			$course_price = $course_info[0]->price;
		} else {
			$course_price = 0;
		}

		$accommo_discount_percent = 0;
		$accommo_waived = 0;
		if (!empty($course_discnt)) {
			if ($course_discnt[0]->discount != 0) {
				$accommo_discount_percent = $course_discnt[0]->discount;
				$accommo_waived = ($accommo_discount_percent / 100) * $course_price;
				//$course_price = $course_price - $accommo_waived; 
			}
		} else {
			$accommo_discount_percent = 0;
			$accommo_waived = 0;
		}
		$data2 = array(
			'price'       => $course_price,
			'accommo_discount_percent'       => $accommo_discount_percent,
			'accommo_waived'       => $accommo_waived
		);

		$data2['promo_price'] = '';
		$data2['promo_christmas'] = '';
		$data2['promo_weeks'] = '';
		$data2['promo_combinable'] = '';
		$data2['promo_start'] = '';
		$data2['promo_end'] = '';
		$data2['promo_before'] = '';

		$data2['accommodation_discount'] = $accommo_waived;
		$data2['accommodation_percent'] = $accommo_discount_percent;
		$data2['accommodation_price'] = $course_price;
		$data2['accommodation_prices'] = $course_price;
		$data2['accommodation_weeks'] = $weeks_num;

		if (!empty($accommodation_info)) {
			$data2['promo_price'] = $accommodation_info->promo_price;
			$data2['promo_christmas'] = $accommodation_info->promo_christmas;
			$data2['promo_weeks'] = $accommodation_info->promo_minweeks;
			$data2['promo_combinable'] = $accommodation_info->promo_combinable;
			$data2['promo_start'] = $accommodation_info->promo_staysstart;
			$data2['promo_end'] = $accommodation_info->promo_staysend;
			$data2['promo_before'] = $accommodation_info->promo_receivedbefore;
		}

		echo json_encode($data2);
	}

	public function fees_get_acco_info()
	{

		$acco_id = $this->input->get('acco_id');
		// school info 
		$this->data['acco_info'] = $this->accommodation_m->get_records_where('*', array('id' => $acco_id), TRUE);
		$data2 = array(
			'acco_info'       => $this->data['acco_info']
		);
		echo json_encode($data2);
	}

	public function fees_get_airp_info()
	{

		$airp_id = $this->input->get('airp_id');
		// school info 
		$this->data['airp_info'] = $this->airports_m->get_records_where('*', array('id' => $airp_id), TRUE);
		$data2 = array(
			'airp_info'       => $this->data['airp_info']
		);
		echo json_encode($data2);
	}

	public function _weekssellectEmpty()
	{
		$data['weeks_all'][''] = '- - Please Select - -';
		$data['weeks_all']['1'] = '1 week';

		return $data['weeks_all'];
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

}
