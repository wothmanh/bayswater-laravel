<?php
class Course_discount extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ($course_id)
	{

		$this->data['course_id'] = $course_id;
	    $erwhere = array('course_id' => $course_id);

        $paginate_info = paginate_it('course_discount/index/'.$course_id, 20, $this->clients_m->count_this('course_discount',$erwhere), 4, ''); 
        $this->data['course_discount'] = $this->course_discount_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/course_discount/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($course_id, $id = NULL)
	{
		if ($id) {
			$this->data['course_discount'] = $this->course_discount_m->get($id);
			!is_null($this->data['course_discount']) || $this->data['errors'][] = 'course course_discount could not be found';
		}
		else {
			$this->data['course_discount'] = $this->course_discount_m->get_new();
		}

		
		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
	 	
	 	

	 	
	 	$this->data['regions'][''] = 'All regions';
		foreach ($this->regions_m->get_records_where('id,name',array()) as $key ){
		    $this->data['regions'][$key->id] = $key->name;
		}
		
		
		$rules = $this->course_discount_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->course_discount_m->array_from_post(array(
				'active','start','ends','discount', 'region_id'
			));
			$data['course_id'] = $course_id;
			$data['made_by'] = $this->session->userdata('id');
			$this->course_discount_m->save($data, $id);
			redirect('course_discount/index/'.$course_id);
		}
		
		$this->data['subview'] = 'admin/course_discount/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($course_id,$id)
	{
		$this->course_discount_m->delete($id);
		redirect('course_discount/index/'.$course_id);
	}

	public function delete_ac ($course_id,$id)
	{
		$this->course_discount_m->delete($id);
		redirect('course_discount/index_ac/'.$course_id);
	}



public function index_ac ($course_id)
	{

		$this->data['course_id'] = $course_id;
	    $erwhere = array('course_id' => $course_id);

        $paginate_info = paginate_it('course_discount/index/'.$course_id, 20, $this->clients_m->count_this('course_discount',$erwhere), 4, ''); 
        $this->data['course_discount'] = $this->course_discount_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/course_discount/index_ac';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit_ac ($course_id, $id = NULL)
	{
		if ($id) {
			$this->data['course_discount'] = $this->course_discount_m->get($id);
			!is_null($this->data['course_discount']) || $this->data['errors'][] = 'course course_discount could not be found';
		}
		else {
			$this->data['course_discount'] = $this->course_discount_m->get_new();
		}

		
		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->course_discount_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->course_discount_m->array_from_post(array(
				'active','ends','discount','start', 'region_id'
			));
			$data['course_id'] = $course_id;
			$data['made_by'] = $this->session->userdata('id');
			$this->course_discount_m->save($data, $id);
			redirect('course_discount/index_ac/'.$course_id);
		}
		
		$this->data['subview'] = 'admin/course_discount/edit_ac';
		$this->load->view('admin/_layout_main', $this->data);
	}

















}