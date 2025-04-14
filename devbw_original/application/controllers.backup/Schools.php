<?php
class Schools extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		if($this->data['user_group']->schools == 0) redirect('fees_calculator');
	}

	public function index ($country_id = 'all', $city_id = 'all')
	{

		$this->data['countries_all']['all'] = 'All countries';
	    foreach ($this->countries_m->get_records_where('id,name') as $key ){
	        $this->data['countries_all'][$key->id] = $this->libre->country($key->name);
	    }
	    $this->data['country_id'] = $country_id;

	    

	    $erwhere = array();	
	    if ($country_id != 'all') {
	    	$erwhere['country_id'] = $country_id;
	    } 

	    $this->data['cities_all']['all'] = 'All cities';
	    foreach ($this->cities_m->get_records_where('id,name',$erwhere) as $key ){
	        $this->data['cities_all'][$key->id] = $key->name;
	    }

	    $this->data['city_id'] = $city_id;

	    if ($city_id != 'all') {
			$erwhere['city_id'] = $city_id;
		}



        $paginate_info = paginate_it('schools/index/'.$country_id.'/'.$city_id, 20, $this->clients_m->count_this('schools',$erwhere), 5, ''); 
        $this->data['schools'] = $this->schools_m->get_limit($paginate_info["per_page"], $paginate_info['page'], $erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/schools/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		if ($id) {
			$this->data['schools'] = $this->schools_m->get($id);
			!is_null($this->data['schools']) || $this->data['errors'][] = 'school could not be found';
		}
		else {
			$this->data['schools'] = $this->schools_m->get_new();
		}

		$this->data['country_all'][''] = 'Choose Country';
		foreach ($this->countries_m->get_records_where('id,name') as $key ){
	        $this->data['country_all'][$key->id] =   $this->libre->country($key->name);
	    }

	    $this->data['currency_all'][''] = 'Choose Currency';
		foreach ($this->currency_m->get_records_where('id,name') as $key ){
	        $this->data['currency_all'][$key->id] =   $key->name;
	    }

		$this->data['cities_all'][''] = 'Choose City';
		foreach ($this->cities_m->get_records_where('id,name') as $key ){
	        $this->data['cities_all'][$key->id] =   $key->name;
	    }

		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->schools_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->schools_m->array_from_post(array(
				'name','active','country_id','city_id','address',
				'insurance','registration_fee','bank_charges','accommodation_fee',
				'books_fee','aramix_fee','currency_id','summer_fees', 'summer_supp_week_off',
                'smr_s_note', 'smr_s_dt_start', 'smr_s_dt_ends', 'guardianship_fee', 
                'christmas_fee', 'christmas_start', 'christmas_end','books_weeks','custodianship_fee'
			));
			$data['made_by'] = $this->session->userdata('id');
			$this->schools_m->save($data, $id);
			redirect('schools');
		}
		
		$this->data['subview'] = 'admin/schools/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}
	

	

	public function get_citiesof()
	{
		$country_id = $this->input->post('country_id');
		$this->data['cities_all'][''] = 'Choose City';
		foreach ($this->cities_m->get_records_where('id,name',array('country_id' => $country_id)) as $key ){
	        $this->data['cities_all'][$key->id] =   $key->name;
	    }

		$this->load->view('admin/ajax_pages/get_citiesof', $this->data);
	}

	public function delete ($id)
	{
		$this->schools_m->delete($id);
		redirect('schools');
	}

}