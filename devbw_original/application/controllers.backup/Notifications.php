<?php
class Notifications extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ()
	{

        $paginate_info = paginate_it('notifications/index', 20, $this->notifications_m->record_count(), 3, ''); 
        $this->data['notifications'] = $this->notifications_m->get_limit($paginate_info["per_page"], $paginate_info['page'], array('user_id' => $this->session->userdata('id')));
        $this->data['links'] = $paginate_info['links'];

		$this->data['subview'] = 'admin/notifications/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		if ($id) {
			$this->data['notifications'] = $this->notifications_m->get($id);
			!is_null($this->data['notifications']) || $this->data['errors'][] = 'notification could not be found';
		}
		else {
			$this->data['notifications'] = $this->notifications_m->get_new();
		}

		

		$this->data['status']['1'] = 'Active';
	 	$this->data['status']["0"] = "Not active";
		
		$rules = $this->notifications_m->rules;
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == TRUE) {
			$data = $this->notifications_m->array_from_post(array(
				'title','body','time','date','active'
			));
			$data['user_id'] = $this->session->userdata('id');
			$this->notifications_m->save($data, $id);
			redirect('notifications');
		}
		
		$this->data['subview'] = 'admin/notifications/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->notifications_m->delete($id);
		redirect('notifications');
	}

}