<?php
class Notes extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('notes_m');
	}

	public function index ($client_id)  
	{

	    $erwhere = array('client_id' => $client_id, 'made_by' => $this->session->userdata('id'));

        $paginate_info = paginate_it('notes/index/'.$client_id, 20, $this->clients_m->count_this('notes',$erwhere), 4, ''); 
        $this->data['notes'] = $this->notes_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

        $this->data['client_id'] = $client_id;

        
		

		$this->data['subview'] = 'admin/notes/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function all ()  
	{
		// http://php.net/manual/en/timezones.php
		date_default_timezone_set("Africa/Casablanca");
        $checkdt =  date("Y-m-d").' '.date("H:i");
	    $erwhere = array('at <=' => $checkdt, 'onoff' => 0, 'made_by' => $this->session->userdata('id'));
	    //$erwhere = array();

	    // echo $this->clients_m->count_this('notes',$erwhere);
	    // exit();

        $paginate_info = paginate_it('notes/all/', 20, $this->clients_m->count_this('notes',$erwhere), 3, ''); 
        $this->data['notes'] = $this->notes_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];


		$this->data['subview'] = 'admin/notes/all';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function on_notes ()  
	{
		// http://php.net/manual/en/timezones.php
		date_default_timezone_set("Africa/Casablanca");
        $checkdtss =  date("Y-m-d").' '.date("H:i");
	    $erwheress = array('at <=' => $checkdtss, 'onoff' => 0, 'made_by' => $this->session->userdata('id'));
        $mynotesnum = $this->clients_m->count_this('notes',$erwheress); 
        echo json_encode(array('ntsnm' => $mynotesnum));
	}

	public function note ($note_id)  
	{
		$this->notes_m->save(array('onoff' => 1), $note_id);
		$this->data['note'] = $this->notes_m->get($note_id);

		$this->data['subview'] = 'admin/notes/note';
		$this->load->view('admin/_layout_main', $this->data);

	}

	public function edit ($client_id, $id = NULL)
	{
		if ($id) {
			$this->data['notes'] = $this->notes_m->get($id);
			!is_null($this->data['notes']) || $this->data['errors'][] = 'Client notes could not be found';
		}
		else {
			$this->data['notes'] = $this->notes_m->get_new();
		}

		$this->data['onoffs']['0'] = 'ON';
	 	$this->data['onoffs']['1'] = "OFF";

		$rules = $this->notes_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->notes_m->array_from_post(array(
				'client_id','note','ndate','ntime','onoff'
			));
			$data['at'] = $data['ndate'].' '.$data['ntime'];
			$data['client_id'] = $client_id;
			$data['made_by'] = $this->session->userdata('id');
			$this->notes_m->save($data, $id);
			redirect('notes/index/'.$client_id);
		}
		
		$this->data['subview'] = 'admin/notes/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($client_id,$id)
	{
		$this->notes_m->delete($id);
		redirect('notes/index/'.$client_id);
	}
	public function deleten ($id)
	{
		$this->notes_m->delete($id);
		redirect('notes/all');
	}

}