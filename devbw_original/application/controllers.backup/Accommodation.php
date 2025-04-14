<?php
class Accommodation extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		if($this->data['user_group']->accommodation == 0) redirect('fees_calculator');

	}

	public function index ($country_id = 'all', $city_id = 'all', $school_id = 'all')
	{
		$this->data['countries_all']['all'] = 'All countries';
	    foreach ($this->countries_m->get_records_where('id,name') as $key ){
	        $this->data['countries_all'][$key->id] = $this->libre->country($key->name);
	    } 

	    $erwhere = array();	
	    if ($country_id != 'all') {
	    	$erwhere['country_id'] = $country_id; 
	    } 

	    $this->data['cities_all']['all'] = 'All cities';
	    foreach ($this->cities_m->get_records_where('id,name',$erwhere) as $key ){
	        $this->data['cities_all'][$key->id] = $key->name;
	    }
	    
	    if ($city_id != 'all') {
			$erwhere['city_id'] = $city_id;
		}

		$this->data['schools_all']['all'] = 'All schools';
		foreach ($this->schools_m->get_records_where('id,name',$erwhere) as $key ){
		    $this->data['schools_all'][$key->id] = $key->name;
		}

		if ($school_id != 'all') {
			$erwhere['school_id'] = $school_id;
		}

		$this->data['country_id'] = $country_id;
		$this->data['city_id'] = $city_id;
	    $this->data['school_id'] = $school_id;

        $paginate_info = paginate_it('accommodation/index/'.$country_id.'/'.$city_id.'/'.$school_id, 20, $this->clients_m->count_this('accommodation',$erwhere), 6, ''); 
        $this->data['accommodation'] = $this->accommodation_m->get_limit($paginate_info["per_page"], $paginate_info['page'], $erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/accommodation/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		if ($id) {
			$this->data['accommodation'] = $this->accommodation_m->get($id);
			!is_null($this->data['accommodation']) || $this->data['errors'][] = 'Accommodation could not be found';
		}
		else {
			$this->data['accommodation'] = $this->accommodation_m->get_new();
		}

		
		$this->data['schools_all'][''] = 'Choose School';
		foreach ($this->schools_m->get_records_where('id,name') as $key ){
	        $this->data['schools_all'][$key->id] =   $key->name;
	    }


		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";

	 	$this->data['course_type']['0'] = 'Accommodation for normal Course';
        $this->data['course_type']["1"] = "Accommodation for academic Semester";
         
        $this->data['guardianship_ons']['1'] = 'Yes';
        $this->data['guardianship_ons']["0"] = "No";
         
        $this->data['christmas_ons']['1'] = 'Yes';
	 	$this->data['christmas_ons']["0"] = "No";
		
		$rules = $this->accommodation_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->accommodation_m->array_from_post(array(
				'name','active','school_id','type','a_summer_fees','a_smr_s_dt_start','a_smr_s_dt_ends','a_smr_s_note', 'guardianship_on', 'christmas_on'
			));
			$data['country_id'] = $this->schools_m->id_to_field($data['school_id'], 'country_id');
			$data['city_id'] = $this->schools_m->id_to_field($data['school_id'], 'city_id');
			$data['made_by'] = $this->session->userdata('id');
			$this->accommodation_m->save($data, $id);
			redirect('accommodation');
		}
		
		$this->data['subview'] = 'admin/accommodation/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->accommodation_m->delete($id);
		redirect('accommodation');
	}

}