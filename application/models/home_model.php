<?php
class Home_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	public function count_social_rows(){
	  return $this->db->count_all("entries");
	}
	
	public function get_all($limit,$start){
	  $this->db->limit($limit, $start);
	  $this->db->order_by("expires", "desc");
	  $query = $this->db->get('entries');
	  if($query->result_array()){
	    return $query->result_array();
    }else{
      return array('error'=>true);
    }
	}
	
	
  
}