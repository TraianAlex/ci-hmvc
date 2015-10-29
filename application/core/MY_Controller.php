<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = [];
	public $view = TRUE;
	public $before_filters = array();
	public $after_filters = array();
/*
	autoload models by adding an array in a attr, models named shorter
	ex. public $models = array('user', 'post');
*/
    public function __construct() {
        parent::__construct();
    }

    public function _remap($method, $parameters){
    	if (method_exists($this, $method)){
			$this->_run_filters('before', $method, $parameters);
				call_user_func_array(array($this, $method), $parameters);
			$this->_run_filters('after', $method, $parameters);
		}else{
			show_404();
		}
		if ($this->view != false && !is_string($this->view)) {
			$this->data['main'] = $method;
			$this->load->view(get_class($this), $this->data);
		}else if(is_string($this->view)){
			$this->data['main'] = $this->view;
			$this->load->view(get_class($this), $this->data);
		}
	}
	/*
	public $before_filters = array( 'authenticate_user', 'fetch_account');
	public $before_filters = array( 'authenticate_user' => array( 'only' => 'secure'),
									    'fetch_account' => array('except' => 'select_account'));
	public $before_filters = array( 'authenticate_user',
									 'fetch_account' => array('except' => 'select_account'));
	*/
	protected function _run_filters($what, $action, $parameters){

		$what = $what . '_filters';
        foreach ($this->$what as $filter => $details) {
            if (is_string($details)) {
                $this->$details($action, $parameters);
            } elseif (is_array($details)) {
                if (in_array($action, @$details['only']) || !in_array($action, @$details['except'])){
                    $this->$filter($action, $parameters);
                }
            }
        }
    }
}