<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct()
 	{
    parent::__construct();
 		$this->load->database();
 		$this->load->library('curl');
 	}
 	
 	public function get_clean_url_string($str) {
  	$search = array(
  		'/\s+/i',
  		'/(-|_)(-|_)*/',
  		'/[^a-z0-9_-]/i'
  	);
  	$replace = array(
  		'-',
  		'$1',
  		''
  	);
    return preg_replace($search, $replace, trim($str));
  }
  
  public function index($args=null)
	{
	  $list = array(
	    "sex",
	    "gay",
	    "boobs",
	    "facebook",
	    "twitter",
	    "snapchat",
	    "lesbian",
	    "test",
	    "fuck",
	    "tired",
	    "bitch",
	    "crap",
	    "suck",
	    "world",
	    "hate",
	    "love",
	    "pussy",
	    "asshole",
	    "social",
	    "kwik",
	    "dick",
	    "penis",
	    "twerk",
	    "miley",
	    "gaga",
	    "feel",
	    "tired",
	    "girl",
	    "woman",
	    "boy",
	    "man",
	    "human",
	    "rights",
	    "success",
	    "fail",
	    "animals",
	    "cat",
	    "dog",
	    "cunt",
	    "fag",
	    "happy",
	    "sad",
	    "network",
	    "fashion",
	    "trend",
	    "normal",
	    "raped",
	    "racism",
	    "loser",
	    "winner",
	    "jesus"
	    );
	    foreach($list as $row){
	      $this->find($row);
	    }
	}
	
	public function find($args=null)
	{
    $q = $this->curl->simple_get('http://api.kwikdesk.com/search?q='.$args);
    $qd = json_decode($q);
    // echo "<pre>";
    //     print_r($qd);
    //     echo "</pre>";
    
    foreach($qd->results as $row){
       
          $uid = explode(' ', $row->content, 4);
          array_pop($uid);
          $cleaned = $this->get_clean_url_string(join('_',$uid));

          $finalid = strtolower($cleaned)."_".$row->expires;

        	$insert_array = array(
        	                     'unique_id'    => $finalid,
        	                     'content'      => $row->content,
        	                     'expires'      => $row->expires,
        	                     'expires_dt'   => $row->expires_dt
        	                   );
        	         
        	         if(!$this->match($finalid)){
        	           $this->db->insert('entries', $insert_array );
      	            }
    }
    
    
  	echo "Search Complete";    
		//$this->load->view("search",$this->_data);
	}
	
	public function match($id = false){
    $this->db->where('unique_id',$id);
 		$query=$this->db->get('entries',1,0);
 		if($query->num_rows()>0)
 		{
 			return true;
 		}else{
       return false;
     }
   }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */