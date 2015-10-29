<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    public function __construct() {
        parent::__construct();
    }
    
    public function error_array() {
        
        if(count($this->_error_array) > 0){
            return $this->_error_array;
        }
    }
    
    public function get_config_rules() {
        return $this->_config_rules;
    }
    
    public function get_field_names($form) {
        $field_names = array();
        $rules = $this->get_config_rules();
        $rules = $rules[$form];
        foreach ($rules as $index=> $info) {
            $field_names[] = $info['field'];
        }
        return $field_names;
    }
    //$params from []
    public function strong_pass($value, $params){

        $this->CI->form_validation->set_message('strong_pass', 'The %s is not strong enough');
        $score = 0;
        if(preg_match('!\d!', $value))     $score++;
        if(preg_match('!\[A-z]!', $value)) $score++;
        if(preg_match('!\W!', $value))     $score++;
        if(strlen($value) >= 8)            $score++;
        if($score < $params)               return false;
        return true;
    }
}
        