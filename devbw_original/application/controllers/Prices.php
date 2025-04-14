<?php
class Prices extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ($course_id)
	{

		$this->data['course_id'] = $course_id;
	    $erwhere = array('course_id' => $course_id);

        $paginate_info = paginate_it('prices/index/'.$course_id, 20, $this->clients_m->count_this('prices',$erwhere), 4, ''); 
        $this->data['prices'] = $this->prices_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/prices/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($course_id, $id = NULL)
	{
		if ($id) {
			$this->data['prices'] = $this->prices_m->get($id);
			!is_null($this->data['prices']) || $this->data['errors'][] = 'course prices could not be found';
		}
		else {
			$this->data['prices'] = $this->prices_m->get_new();
		}

		
		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->prices_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->prices_m->array_from_post(array(
				'active','start','ends','price'
			));
			$data['course_id'] = $course_id;
			$data['made_by'] = $this->session->userdata('id');
			$this->prices_m->save($data, $id);
			redirect('prices/index/'.$course_id);
		}
		
		$this->data['subview'] = 'admin/prices/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($course_id,$id)
	{
		$this->prices_m->delete($id);
		redirect('prices/index/'.$course_id);
	}

	public function delete_ac ($course_id,$id)
	{
		$this->prices_m->delete($id);
		redirect('prices/index_ac/'.$course_id);
	}



public function index_ac ($course_id)
	{

		$this->data['course_id'] = $course_id;
	    $erwhere = array('course_id' => $course_id);

        $paginate_info = paginate_it('prices/index/'.$course_id, 20, $this->clients_m->count_this('prices',$erwhere), 4, ''); 
        $this->data['prices'] = $this->prices_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/prices/index_ac';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit_ac ($course_id, $id = NULL)
	{
		if ($id) {
			$this->data['prices'] = $this->prices_m->get($id);
			!is_null($this->data['prices']) || $this->data['errors'][] = 'course prices could not be found';
		}
		else {
			$this->data['prices'] = $this->prices_m->get_new();
		}

		
		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->prices_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->prices_m->array_from_post(array(
				'active','ends','price','start'
			));
			$data['course_id'] = $course_id;
			$data['made_by'] = $this->session->userdata('id');
			$this->prices_m->save($data, $id);
			redirect('prices/index_ac/'.$course_id);
		}
		
		$this->data['subview'] = 'admin/prices/edit_ac';
		$this->load->view('admin/_layout_main', $this->data);
	}

















}