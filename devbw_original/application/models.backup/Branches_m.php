<?php
class Branches_m extends MY_Model
{
	protected $_table_name = 'branches';
	protected $_order_by = 'id asc';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'name', 
			'rules' => 'trim|required|max_length[100]'
		),
		'active' => array(
			'field' => 'active', 
			'label' => 'active', 
			'rules' => 'trim|max_length[1]'
		)
		
	);

	public function get_new ()
	{
		$branch = new stdClass();
		$branch->name = '';
		$branch->active = '';
		return $branch;
	}


}