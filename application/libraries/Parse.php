<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Parse {
    const 		PARSE_CONFIG_FILE = 'parse';

	/**
	 * Reference to code CodeIgniter instance.
	 * 
	 * @var CodeIgniter object
	 */
	private $_ci;
	
	private $rest_client;
	private $parse_user;
	private $parse_user_instance;

	/**
	 * constructor of twig ci class
	 */
	public function __construct() 
	{
		$this->_ci = & get_instance();
		//$this->_ci->config->load(self::PARSE_CONFIG_FILE); // load config file
		// set include path for twig
		ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'third_party/parse');
		require_once (string)'parse.php';
		
		log_message('debug', 'parse loaded');
    $this->rest_client = new parseRestClient();
	}

	/**
	 * render a twig template file
	 * 
	 * @param string  $template template name
	 * @param array   $data	    contains all varnames
	 * @param boolean $render   render or return raw?
	 *
	 * @return void
	 * 
	 */
	public function user($username, $password) 
	{
	  $this->parse_user = new parseUser();
    $this->parse_user->username = $username;
    $this->parse_user->password = $password;
    $this->parse_user_instance = $this->parse_user->login();
    
		return $this->parse_user_instance;
	}

	/**
	 * Execute the template and send to CI output
	 * 
	 * @param string $template Name of template
	 * @param array  $data     Parameters for template
	 * 
	 * @return void
	 * 
	 */
	public function display($template, $data = array()) 
	{
		$template = $this->_twig_env->loadTemplate($template);
		$this->_ci->output->set_output($template->render($data));
	}

}

/* End of file Parse.php */
/* Location: ./libraries/Parse.php */
