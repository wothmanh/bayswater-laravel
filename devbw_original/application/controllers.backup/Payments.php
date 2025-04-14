<?php
class Payments extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ($client_id)  
	{

	    $erwhere = array('client_id' => $client_id);

        $paginate_info = paginate_it('payments/index/'.$client_id, 20, $this->clients_m->count_this('payments',$erwhere), 4, ''); 
        $this->data['payments'] = $this->payments_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

        if (!empty($this->data['payments'])) {
        	$ttslsdf = $this->payments_m->direct_query('SELECT SUM(price)  AS totalpaid FROM payments WHERE client_id = '.$client_id);
			$this->data['total_paid'] = $ttslsdf[0]->totalpaid.' '.$this->currency_m->id_to_field($this->data['payments'][0]->currency_id, 'name');;
        	$this->data['client_id'] = $client_id;
        } else {
        	$this->data['total_paid'] = "00.00";
        	$this->data['client_id'] = NULL;
        }

        
		

		$this->data['subview'] = 'admin/payments/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($client_id, $id = NULL)
	{
		if ($id) {
			$this->data['payments'] = $this->payments_m->get($id);
			!is_null($this->data['payments']) || $this->data['errors'][] = 'course payments could not be found';
		}
		else {
			$this->data['payments'] = $this->payments_m->get_new();
		}

		$this->data['currency_all'][''] = 'Choose Currency';
		foreach ($this->currency_m->get_records_where('id,name') as $key ){
	        $this->data['currency_all'][$key->id] =   $key->name;
	    }
		
		$rules = $this->payments_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->payments_m->array_from_post(array(
				'client_id','price','currency_id'
			));
			$data['client_id'] = $client_id;
			$data['made_by'] = $this->session->userdata('id');
			$this->payments_m->save($data, $id);
			redirect('payments/index/'.$client_id);
		}
		
		$this->data['subview'] = 'admin/payments/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->payments_m->delete($id);
		redirect('payments');
	}

}