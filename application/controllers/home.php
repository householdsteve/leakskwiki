<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
 		$this->load->library('twig');
 		$this->load->helper('url');
 	}
	public function tester($args=null)
	{
	  $this->load->library('parse');
	  print_r($this->parse->user("steve","20armani13"));
	  echo "<pre>";
	  print_r($this->parse->find("test"));
	  echo "</pre>";
	}
	public function index($args=null)
	{
	  $this->load->database();
       $ok = "nope";
       if($this->input->is_ajax_request()){
         $ok = "yep";
       }
        $pagevars = array(
               "appenv"=>$_SERVER["APPENV"], // THIS ALLOWS US TO WRITE VARIABLES BASE ON ENVIRONMENT
               "baseurl"=> base_url(), // THE BASE URL OF THE SITE
               "ajax" => $ok,
               "titlebase" => "Kwiki Leaks - ", // THE FIRST PART OF THE PAGE TITLE
               "title"=>"Nothing is deleted", // THE SECOND PART OF PAGE TITLE. THIS SHOULD BE EXTENDED BELOW BASED ON CONTENT
               "description" => "Kwikdesk allows users to anonymously share their thoughts. These 'kwiks' should be deleted automatically, however just as everything else on the internet it will also be reproduced. Please take time to browse the most popular words on facebook and watch how humans express themselves when no one is reading.", // THIS IS FOR META TAGS
               "keywords" => "kwikdesk, kwik, snapchat, twitter, facebook, leaks, wiki", // THIS TOO, THESE BOTH SHOULD BE EXTENDED BASED ON CONTEXT
               "og" => array("image"=> base_url()."assets/img/kwikileaks-kwikdesk_logo.png",
                             "title"=> "Kwiki Leaks - No one is reading...") // THESE ARE FOR SOCIAL CHANNELS LIKE FACEBOOK WHERE AN IMAGE IS SHARED.
          );
          
          $this->load->library('pagination');
          $this->load->model('home_model');

          		$config['base_url'] = '/home/index';
              $config['uri_segment'] = 3;
              $config['total_rows'] = $this->home_model->count_social_rows();
              $config['per_page'] = 20;
              $config['display_pages'] = FALSE;
              $config['anchor_class'] = 'class="infinite-more-link"';
              $config['prev_link'] = FALSE;
              $config['first_link'] = FALSE;
              $config['last_link'] = FALSE;
              $config['next_tag_open'] = '';
              $config['next_tag_close'] = ' ';

              $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

              $this->_data['data'] = $this->home_model->get_all($config['per_page'],$page);

              $this->pagination->initialize($config);

              $this->_data['pagination'] = $this->pagination->create_links();
              //echo $this->_data['pagination'];
       
    $this->twig->display('index.inc', array('pagevars'=> (object) $pagevars, 'data' => $this->_data));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */