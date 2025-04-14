<?php
class Countries extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		if($this->data['user_group']->countries == 0) redirect('fees_calculator');
	}

	public function index ()
	{

        $paginate_info = paginate_it('countries/index', 20, $this->countries_m->record_count(), 3, ''); 
        $this->data['countries'] = $this->countries_m->get_limit($paginate_info["per_page"], $paginate_info['page']);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/countries/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		if ($id) {
			$this->data['country'] = $this->countries_m->get($id);
			!is_null($this->data['country']) || $this->data['errors'][] = 'country could not be found';
		}
		else {
			$this->data['country'] = $this->countries_m->get_new();
		}

		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->countries_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->countries_m->array_from_post(array(
				'name','active'
			));
			$data['made_by'] = $this->session->userdata('id');
			$this->countries_m->save($data, $id);
			redirect('countries');
		}
		
		$this->data['subview'] = 'admin/countries/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->countries_m->delete($id);
		redirect('countries');
	}

}