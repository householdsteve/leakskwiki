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
  
  public function fraction_time()
  {
    $t = intval(date('i'));
    switch($t){
      case $t == 0 || $t < 10:
        $frac = 0;
      break;
      case $t > 9 && $t < 19:
        $frac = 1;
      break;
      case $t > 19 && $t < 30:
        $frac = 2;
      break;
      case $t > 29 && $t < 50:
        $frac = 3;
      break;
      case $t > 49 && $t < 60:
        $frac = 4;
      break;
    }
    echo $frac;
    return $frac;
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
	    "confess",
	    "confession",
	    "war",
	    "depressed",
	    "jew",
	    "jewish",
	    "fight",
	    "drug",
	    "bong",
	    "weed",
	    "cocaine",
	    "heroin",
	    "meth",
	    "virgin",
	    "cheated",
	    "grindr",
	    "secret",
	    "hurt",
	    "god",
	    "honest",
	    "wired",
	    "wife",
	    "husband",
	    "sister",
	    "brother",
	    "friend",
	    "stole",
	    "gave",
	    "lost",
	    "virgin",
	    "bully",
	    "nerd",
	    "geek",
	    "blowjob",
	    "handjob",
	    "bomb",
	    "kill",
	    "television",
	    "internet",
	    "cable",
	    "summer",
	    "winter",
	    "fall",
	    "spring",
	    "arab",
	    "gun",
	    "today",
	    "year",
	    "tomorrow",
	    "beer",
	    "weapon",
	    "jail",
	    "irishtech",
	    "kwikdesk",
	    "spotify",
	    "joke",
	    "unicorns",
	    "jesus",
	    "thanksgiving",
	    "xmas",
	    "christmas",
	    "want",
	    "truth",
	    "lie",
	    "lied",
	    "relationships"
	    );
	    
	    shuffle($list);
	    foreach($list as $row){
	      $this->find($row);
	    }
	    
	    echo "Search Complete";
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