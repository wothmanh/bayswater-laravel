<?php
class Accomo_discount extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ($acco_id)
	{

		$this->data['acco_id'] = $acco_id;
	    $erwhere = array('acco_id' => $acco_id);

        $paginate_info = paginate_it('accomo_discount/index/'.$acco_id, 20, $this->clients_m->count_this('accomo_discount',$erwhere), 4, ''); 
        $this->data['accomo_discount'] = $this->accomo_discount_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/accomo_discount/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($acco_id, $id = NULL)
	{
		if ($id) {
			$this->data['accomo_discount'] = $this->accomo_discount_m->get($id);
			!is_null($this->data['accomo_discount']) || $this->data['errors'][] = 'Accommodation discount could not be found';
		}
		else {
			$this->data['accomo_discount'] = $this->accomo_discount_m->get_new();
		}

		
		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->accomo_discount_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->accomo_discount_m->array_from_post(array(
				'active','start','ends','discount'
			));
			$data['acco_id'] = $acco_id;
			$data['made_by'] = $this->session->userdata('id');
			$this->accomo_discount_m->save($data, $id);
			redirect('accomo_discount/index/'.$acco_id);
		}
		
		$this->data['subview'] = 'admin/accomo_discount/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($acco_id,$id)
	{
		$this->accomo_discount_m->delete($id);
		redirect('accomo_discount/index/'.$acco_id);
	}


















}