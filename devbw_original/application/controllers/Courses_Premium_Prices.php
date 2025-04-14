<?php
class Courses_Premium_Prices extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ($course_premium_id)
	{
		$this->data['course_premium_id'] = $course_premium_id;
	    $erwhere = array('course_premium_id' => $course_premium_id);

        $paginate_info = paginate_it('courses_premium_prices/index/'.$course_premium_id, 20, $this->clients_m->count_this('courses_premium_prices',$erwhere), 4, ''); 
        $this->data['prices'] = $this->courses_premium_prices_m->get_limit($paginate_info["per_page"], $paginate_info['page'],$erwhere);
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/courses_premium_prices/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($course_premium_id, $id = NULL)
	{
		if ($id) {
			$this->data['prices'] = $this->courses_premium_prices_m->get($id);
			!is_null($this->data['prices']) || $this->data['errors'][] = 'course prices could not be found';
		}
		else {
			$this->data['prices'] = $this->courses_premium_prices_m->get_new();
		}
		
		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->courses_premium_prices_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->courses_premium_prices_m->array_from_post(array('duration', 'price', 'active'));
			$data['course_premium_id'] = $course_premium_id;
			$data['created_by'] = $this->session->userdata('id');
			$this->courses_premium_prices_m->save($data, $id);
			redirect('courses_premium_prices/index/'.$course_premium_id);
		}
		
		$this->data['subview'] = 'admin/courses_premium_prices/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($course_exam_id,$id)
	{
		$this->courses_premium_prices_m->delete($id);
		redirect('courses_premium_prices/index/'.$course_exam_id);
	}

}