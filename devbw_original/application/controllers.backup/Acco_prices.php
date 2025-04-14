<?php
class Acco_prices extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		if($this->data['user_group']->accommodation == 0) redirect('fees_calculator');
	}

	public function index ($acco_id)
	{

		$this->data['acco_id'] = $acco_id;
	    $erwhere = array('acco_id' => $acco_id);

        $paginate_info = paginate_it('acco_prices/index/'.$acco_id, 20, $this->clients_m->count_this('acco_prices',$erwhere), 4, ''); 
        $this->data['prices'] = $this->acco_prices_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/acco_prices/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($acco_id, $id = NULL)
	{
		if ($id) {
			$this->data['prices'] = $this->acco_prices_m->get($id);
			!is_null($this->data['prices']) || $this->data['errors'][] = 'Accommodation prices could not be found';
		}
		else {
			$this->data['prices'] = $this->acco_prices_m->get_new();
		}

		
		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";

		
		$rules = $this->acco_prices_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->acco_prices_m->array_from_post(array(
				'active','start','ends','price'
			));

			if ($this->accommodation_m->id_to_field($acco_id,'type') == 0) $data['type'] = 0;
			else $data['type'] = 1;
			$data['acco_id'] = $acco_id;
			$data['made_by'] = $this->session->userdata('id');
			$this->acco_prices_m->save($data, $id);
			redirect('acco_prices/index/'.$acco_id);
		}
		
		$this->data['subview'] = 'admin/acco_prices/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->acco_prices_m->delete($id);
		redirect('acco_prices');
	}

}