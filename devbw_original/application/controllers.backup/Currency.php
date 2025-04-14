<?php
class Currency extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		if($this->data['user_group']->currency == 0) redirect('fees_calculator');
	}

	public function index ()
	{

        $paginate_info = paginate_it('currency/index', 20, $this->currency_m->record_count(), 3, ''); 
        $this->data['currency'] = $this->currency_m->get_limit($paginate_info["per_page"], $paginate_info['page']);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/currency/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		if ($id) {
			$this->data['currency'] = $this->currency_m->get($id);
			!is_null($this->data['currency']) || $this->data['errors'][] = 'Currency could not be found';
		}
		else {
			$this->data['currency'] = $this->currency_m->get_new();
		}


		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->currency_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->currency_m->array_from_post(array(
				'name','active','sar_price'
			));
			$data['made_by'] = $this->session->userdata('id');
			$this->currency_m->save($data, $id);
			redirect('currency');
		}
		
		$this->data['subview'] = 'admin/currency/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->currency_m->delete($id);
		redirect('currency');
	}

}