<?php
class Regions extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		if($this->data['user_group']->countries == 0) redirect('fees_calculator');
	}

	public function index ()
	{

        $paginate_info = paginate_it('regions/index', 20, $this->regions_m->record_count(), 3, ''); 
        $this->data['regions'] = $this->regions_m->get_limit($paginate_info["per_page"], $paginate_info['page']);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/regions/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		if ($id) {
			$this->data['region'] = $this->regions_m->get($id);
			!is_null($this->data['region']) || $this->data['errors'][] = 'region could not be found';
		}
		else {
			$this->data['region'] = $this->regions_m->get_new();
		}

		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->regions_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->regions_m->array_from_post(array(
				'name','active'
			));
			$data['made_by'] = $this->session->userdata('id');
			$this->regions_m->save($data, $id);
			redirect('regions');
		}
		
		$this->data['subview'] = 'admin/regions/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->regions_m->delete($id);
		redirect('regions');
	}

}