<?php
class Airports extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		if($this->data['user_group']->airports == 0) redirect('fees_calculator');
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


	     $paginate_info = paginate_it('airports/index/'.$country_id.'/'.$city_id.'/'.$school_id, 20, $this->airports_m->count_this('airports',$erwhere), 6, ''); 
        $this->data['airports'] = $this->airports_m->get_limit($paginate_info["per_page"], $paginate_info['page'], $erwhere);

        // $paginate_info = paginate_it('airports/index', 20, $this->airports_m->record_count(), 3, ''); 
        // $this->data['airports'] = $this->airports_m->get_limit($paginate_info["per_page"], $paginate_info['page']);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/airports/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		if ($id) {
			$this->data['airports'] = $this->airports_m->get($id);
			!is_null($this->data['airports']) || $this->data['errors'][] = 'airports could not be found';
		}
		else {
			$this->data['airports'] = $this->airports_m->get_new();
		}

		
		$this->data['schools_all'][''] = 'Choose School';
		foreach ($this->schools_m->get_records_where('id,name') as $key ){
	        $this->data['schools_all'][$key->id] =   $key->name;
	    }


		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->airports_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->airports_m->array_from_post(array(
				'name','active','school_id','arrival_price','departure_price'
			));

			$schoolInfo = $this->schools_m->get($data['school_id']);
			$data['country_id'] = $schoolInfo->country_id;
			$data['city_id'] = $schoolInfo->city_id;
			$data['made_by'] = $this->session->userdata('id');
			$this->airports_m->save($data, $id);
			redirect('airports');
		}
		
		$this->data['subview'] = 'admin/airports/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->airports_m->delete($id);
		redirect('airports');
	}

}