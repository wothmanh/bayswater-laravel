<?php

class Courses extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		if($this->data['user_group']->courses == 0) redirect('fees_calculator');	
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


        $paginate_info = paginate_it('courses/index/'.$country_id.'/'.$city_id.'/'.$school_id, 20, $this->clients_m->count_this('courses',$erwhere), 6, ''); 
        $this->data['courses'] = $this->courses_m->get_limit($paginate_info["per_page"], $paginate_info['page'], $erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/courses/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		if ($id) {
			$this->data['courses'] = $this->courses_m->get($id);
			!is_null($this->data['courses']) || $this->data['errors'][] = 'courses could not be found';
		}
		else {
			$this->data['courses'] = $this->courses_m->get_new();
		}

		
		$this->data['schools_all'][''] = 'Choose School';
		foreach ($this->schools_m->get_records_where('id,name') as $key ){
	        $this->data['schools_all'][$key->id] =   $key->name;
	    }
	    
	    


		$this->data['course_type']['0'] = 'Normal Course';
	 	$this->data['course_type']["1"] = "Academic Semester";

	 	$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->courses_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->courses_m->array_from_post(array(
				'name','active','school_id','type','start'
			));
			
			$data['country_id'] = $this->schools_m->id_to_field($data['school_id'], 'country_id');
			$data['city_id'] = $this->schools_m->id_to_field($data['school_id'], 'city_id');
			$data['made_by'] = $this->session->userdata('id');
			$this->courses_m->save($data, $id);
			redirect('courses');
		}
		
		$this->data['subview'] = 'admin/courses/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->courses_m->delete($id);
		redirect('courses');
	}

}