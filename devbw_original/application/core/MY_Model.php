<?php
class MY_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $rules = array();
	protected $_timestamps = FALSE;
	
	function __construct() {
		parent::__construct();
	}
	
	public function array_from_post($fields){
		$data = array();
		foreach ($fields as $field) {
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}

	public function get_ovrlsldrsmc($row, $e_where=array()){
		$this->db->select($row);
		if (count($e_where) != 0) {
			$this->db->where($e_where);
		}
		$this->db->limit(1);
		return $this->db->get($this->_table_name)->row();
	}
	
	public function get_limit($limit, $start, $my_array= array()) 
   {
   	if (count($my_array) != 0) {
   		$this->db->where($my_array);
   	}
   	// if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
// 		}
	$this->db->select()->from($this->_table_name)->limit($limit, $start);
	$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

   public function get_llients($limit, $start, $my_array= array()) 
   {
   	if (count($my_array) != 0) {
   		$this->db->where($my_array);
   	}
   	// if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
// 		}
	$this->db->select()->from($this->_table_name)->limit($limit, $start);
	$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

   public function get_llientsff( $my_array= array()) 
   {
   	if (count($my_array) != 0) {
   		$this->db->where($my_array);
   	}
   	// if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
// 		}
	$this->db->select()->from($this->_table_name);
	$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function print_get_llients($errows,$my_array= array()) 
   	{
   	if (count($my_array) != 0) {
   		$this->db->where($my_array);
   	}
   	// if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
// 		}
	$this->db->select($errows)->from($this->_table_name);
	$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function coulients($table, $wheres)
	{
	    $this->db->where($wheres);
	    $query = $this->db->count_all_results($table);
	    return $query;

	}

	
	public function get($id = NULL, $single = FALSE){
		
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
// 		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
// 		}
		return $this->db->get($this->_table_name)->$method();
	}

	public function id_to_name($id){

			$this->db->select('id,name');
			$this->db->where(array('id'=> $id));
		return $this->db->get($this->_table_name)->row();
	}

	public function id_to_field($id, $erfield){

			$this->db->select('id,'.$erfield);
			$this->db->where(array('id'=> $id));
		return $this->db->get($this->_table_name)->row()->$erfield;
	}
	
	public function get_where($e_where , $id = NULL, $single = FALSE){
		
		$this->db->where($e_where);
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
// 		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
// 		}
		return $this->db->get($this->_table_name)->$method();
	}

	public function get_records_where($records, $e_where=array(), $single = FALSE){
		
		$this->db->select($records);
		$this->db->where($e_where);
		if ($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
// 		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
// 		}
		return $this->db->get($this->_table_name)->$method();
	}

	public function get_records_whereord5($records, $e_where=array(), $single = FALSE){
		
		$this->db->select($records);
		$this->db->where($e_where);
		if ($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
// 		if (!count($this->db->ar_orderby)) {
			$this->db->order_by('ends asc');
// 		}
		return $this->db->get($this->_table_name)->$method();
	}


		
	public function direct_query($qry){
		$query = $this->db->query($qry);
		return $query->result();
	}
	
	public function get_by($where, $single = FALSE){
		$this->db->where($where);
		return $this->get(NULL, $single);
	}

	public function get_row_by($where, $row,$single = FALSE){
		$this->db->select($row);
		$this->db->where($where);
		return $this->get(NULL, $single);
	}
	
	public function save($data, $id = NULL){
		
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = $now;
			$data['modified'] = $now;
		}
		
		// Insert
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}
		
		return $id;
	}
	
	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		
		if (!$id) {
			return FALSE;
		}
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}






































	public function get_join($table_compaire, $joined_compaire, $joined_tb, $add_fields, $where_a, $limit = FALSE, $start = FALSE ,$single = FALSE)
	{
		if($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
// 		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
// 		}
		$this->db->select($this->_table_name.'.*,'.$add_fields, FALSE);
		$this->db->from($this->_table_name);
		$this->db->join($joined_tb, $joined_tb.'.'.$joined_compaire.' = '.$this->_table_name.'.'.$table_compaire);
		$this->db->where($where_a);
		if($limit != FALSE) {
			$this->db->limit($limit, $start);
		}
		return $this->db->get()->$method();
	}








	public function test_join($joined_tb, $fields_f_t2 , $compare_t1_t2, $where_a, $single = FALSE)
	{
		if($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}

		$this->db->select($this->_table_name.'.*', FALSE);
		
		$this->db->select($fields_f_t2, FALSE);
		$this->db->from($this->_table_name);
		$this->db->join($joined_tb, $compare_t1_t2); // $compare_t1_t2 == 'tableA.name = tableB.name'
		$this->db->where($where_a);

		return $this->db->get()->$method();
	}
	public function get_join2($joined_table, $id = NULL, $single = FALSE){
		$this->db->join($joined_table,$joined_table.".profile_id=".$this->_table_name.".id",'inner');
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
// 		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
// 		}
		return $this->db->get($this->_table_name)->$method();
	}



















































	 public function record_count() {
        return $this->db->count_all($this->_table_name);
    }

	public function count_this($table, $wheres)
	{
		    $this->db->where($wheres);
		    $query = $this->db->count_all_results($table);
		    return $query;

	}
	public function count_this_like($table, $wheres)
	{
		    $this->db->like($wheres);
		    $query = $this->db->count_all_results($table);
		    return $query;

	}

	public function get_limit_like($limit, $start, $my_array= array()) 
   {
   	if (count($my_array) != 0) {
   		$this->db->escape_like_str($my_array);
   		$this->db->like($my_array);
   	}
	$this->db->select()->from($this->_table_name)->limit($limit, $start);
	$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

	public function get_search($search_array){
		
		$this->db->like($search_array);
// 		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
// 		}
		return $this->db->get($this->_table_name)->result();
	}



public function save_where($data, $save_where, $limit = FALSE , $start = FALSE ){
		
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$data['created'] = $now;
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			if($limit != FALSE) {
				$this->db->limit($limit, $start);
			}
			$this->db->set($data);
			$this->db->where($save_where);
			$this->db->update($this->_table_name);
		}
		
		return true;
	}












}