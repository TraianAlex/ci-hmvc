<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model {
    
    public $before_create = ['prep_data', 'created_at'];
    public $before_update = ['updated_at'];

	protected function prep_data($data){
		$data['password'] = $this->encrypt_pass($this->input->post('password'));
		$data['active'] = 1;//change after confirm by email. after come back is 1
		$data['ip_address'] = $this->input->ip_address();
		return $data;
	}

	public function encrypt_pass($data){
		$options = ['cost'=> 12];
		return password_hash($data, PASSWORD_BCRYPT, $options);
	}
	//for callback_validate_credentials and index
    public function login_user($email, $password) {

		$this->db->where('email', $email);
		$result = $this->db->get('users');
		if($result->row(2)){//cond if when use it like callback (ci)
			$db_password = $result->row(2)->password;
			if(password_verify($password, $db_password)) {
				return $result->row(0)->id;
			} else {
				return false;
			}
		}else{
			return false;
		}
	}

	public function set_session_data($user_id, $data){
		$user_data = [
	        'id' => $user_id,
	        'email' => $data['email'],
	        'logged_in' => TRUE
	    ];
	    return $user_data;
	}
	//for callback_validate_email
	public function email_exist($email){
		$data = $this->get_by('email', $email);
		if($data){
			return $data->email == $email ? true : false;
		}
		return false;
	}
	//send a temp password to user
	public function change_pass($email){
		$password = substr ( md5(uniqid(rand(), true)), 3, 10);
		$pass_encrypted = $this->encrypt_pass($password);
		$result = $this->update_by(['email' => $email], ['password' => $pass_encrypted]);
		return $result ? $password : false;
	}
}