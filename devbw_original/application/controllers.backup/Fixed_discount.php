<?php
class Fixed_discount extends Admin_Controller
{
    
    
    	public function __construct ()
	{
		parent::__construct();
	}

	public function index ($course_id)
	{

		$this->data['course_id'] = $course_id;
	    $erwhere = array('course_id' => $course_id);

        $paginate_info = paginate_it('fixed_discount/index/'.$course_id, 20, $this->clients_m->count_this('fixed_discount',$erwhere), 4, ''); 
        $this->data['fixed_discount'] = $this->fixed_discount_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/fixed_discount/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($course_id, $id = NULL)
	{
		if ($id) {
			$this->data['fixed_discount'] = $this->fixed_discount_m->get($id);
			!is_null($this->data['fixed_discount']) || $this->data['errors'][] = 'course fixed discount could not be found';
		}
		else {
			$this->data['fixed_discount'] = $this->fixed_discount_m->get_new();
		}

		
		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
	 	
	 	

	 	
	 	$this->data['regions'][''] = 'All regions';
		foreach ($this->regions_m->get_records_where('id,name',array()) as $key ) {
		    $this->data['regions'][$key->id] = $key->name;
		}
		
		
		$rules = $this->fixed_discount_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->fixed_discount_m->array_from_post(array(
				'sum_course','text_course','sum_accommo', 'text_accommo', 'region_id', 'active'
			));
			$data['course_id'] = $course_id;
			$data['made_by'] = $this->session->userdata('id');
			$this->fixed_discount_m->save($data, $id);
			redirect('fixed_discount/index/'.$course_id);
		}
		
		$this->data['subview'] = 'admin/fixed_discount/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($course_id,$id)
	{
		$this->fixed_discount_m->delete($id);
		redirect('fixed_discount/index/'.$course_id);
	}
	
	
	
/*
	public function __construct ()
	{
		parent::__construct();
	}

	public function index ($course_id, $school_id)
	{
		$hasdiscount = true;
		$this->data['fixed_discount'] = $this->fixed_discount_m->get_where(array('course_id' => $course_id), NULL, TRUE);
		if (empty($this->data['fixed_discount'])) {
			$hasdiscount = false;
			$this->data['fixed_discount'] = $this->fixed_discount_m->get_new();
		}

		
		$rules = $this->fixed_discount_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->fixed_discount_m->array_from_post(array(
				'sum_course','text_course','sum_accommo', 'text_accommo'
			));
			$data['course_id'] = $course_id;
			$data['made_by'] = $this->session->userdata('id');
			if($hasdiscount) {
				$this->fixed_discount_m->save_where($data,array('course_id' => $course_id));
			} else {
				$this->fixed_discount_m->save($data);
			}
			redirect('courses/index/all/all/'.$school_id);
		}
		
		$this->data['subview'] = 'admin/fixed_discount/index';
		$this->load->view('admin/_layout_main', $this->data);
	}


*/
















}