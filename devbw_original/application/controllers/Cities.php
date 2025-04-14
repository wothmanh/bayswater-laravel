<?php
class Cities extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		if($this->data['user_group']->cities == 0) redirect('fees_calculator');
	}

	public function index ($country_id = 'all')
	{

		$this->data['countries_all']['all'] = 'All countries';
	    foreach ($this->countries_m->get_records_where('id,name') as $key ){
	        $this->data['countries_all'][$key->id] = $this->libre->country($key->name);
	    }
	    $this->data['country_id'] = $country_id;

	    if ($country_id == 'all') {
	    	$erwhere = array();	    
	    } else {
	    	$erwhere = array('country_id' => $country_id);
	    }



        $paginate_info = paginate_it('cities/index/'.$country_id, 20, $this->clients_m->count_this('cities',$erwhere), 4, ''); 
        $this->data['cities'] = $this->cities_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/cities/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		if ($id) {
			$this->data['cities'] = $this->cities_m->get($id);
			!is_null($this->data['cities']) || $this->data['errors'][] = 'city could not be found';
		}
		else {
			$this->data['cities'] = $this->cities_m->get_new();
		}

		

		foreach ($this->countries_m->get_records_where('id,name') as $key ){
	        $this->data['country_all'][$key->id] =   $this->libre->country($key->name);
	    }


		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->cities_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->cities_m->array_from_post(array(
				'name','active','country_id'
			));
			$data['made_by'] = $this->session->userdata('id');
			$this->cities_m->save($data, $id);
			redirect('cities');
		}
		
		$this->data['subview'] = 'admin/cities/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->cities_m->delete($id);
		redirect('cities');
	}

}