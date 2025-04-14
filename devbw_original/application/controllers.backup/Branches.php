<?php
class Branches extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		if($this->data['user_group']->branches == 0) redirect('fees_calculator');
	}

	public function index ()
	{

        $paginate_info = paginate_it('branches/index/', 20, $this->branches_m->record_count(), 4, ''); 
        $this->data['branches'] = $this->branches_m->get_limit($paginate_info["per_page"], $paginate_info['page']);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/branches/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		if ($id) {
			$this->data['branches'] = $this->branches_m->get($id);
			!is_null($this->data['branches']) || $this->data['errors'][] = 'Branch could not be found';
		}
		else {
			$this->data['branches'] = $this->branches_m->get_new();
		}

		

		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->branches_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->branches_m->array_from_post(array(
				'name','active'
			));
			$this->branches_m->save($data, $id);
			redirect('branches');
		}
		
		$this->data['subview'] = 'admin/branches/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->branches_m->delete($id);
		redirect('branches');
	}

}