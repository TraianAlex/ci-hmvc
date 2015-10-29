<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auths extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        //$this->output->enable_profiler(TRUE);
    }

    public function index() {

        $this->user_model->set_validation('login');
        $data = data_post(['email', 'password']);
        if ($this->user_model->validate($data) == FALSE) {
            $this->session->set_flashdata('m', validation_errors());
        }else{
            $user_id = $this->user_model->login_user($data['email'], $data['password']);
            if($user_id) {
                $this->session->set_userdata($this->user_model->set_session_data($user_id, $data));
                $this->session->set_flashdata('m', '<p>Welcome '.$data['email'].'</p>');
                redirect('auths/user/' . $user_id);
            }
        }
    }
    //callback
    public function _validate_credentials(){

        if ($this->user_model->login_user($this->input->post('email'), $this->input->post('password'))){
            return true;
        }else{
            $this->form_validation->set_message('_validate_credentials', 'Incorrect username / password.');
            return false;
        }
    }

    public function register(){

        $this->user_model->set_validation('signup');
        if ($user_id = $this->user_model->insert(data_post(['email', 'password']))){
            $this->session->set_flashdata('m', '<p>Registerd</p>');
        }else{
            $this->session->set_flashdata('m', validation_errors());
        }
    }

    public function user(){
        $id = $this->session->userdata('id') != $this->uri->segment(3) ?
                $this->session->userdata('id') : $this->session->userdata('id');
        $this->data['user'] = $this->user_model->get($id);
    }

    public function edit(){

        $this->view = 'register';
        $user_id = $this->session->userdata('id') != $this->uri->segment(3) ?
                $this->session->userdata('id') : $this->session->userdata('id');
        $this->data['user'] = $this->user_model->get($user_id);
        $this->user_model->set_validation('edit');
        if ($this->user_model->update($user_id, data_post(['email']))){
            $this->session->set_flashdata('m', '<p>Saved</p>');
            redirect('auths/user/' . $user_id);
        }else{
            $this->session->set_flashdata('m', validation_errors());
        }
    }
    // Do NOT validate if email already exists //callback__unique_email for update
    // UNLESS it's the email for the current user
    public function _unique_email(){
        
        $id = $this->session->userdata('id');
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('id !=', $id);
        $user = $this->db->get('users')->result();
        if (count($user)) {
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return FALSE;
        }
        return TRUE;
    }

    public function forgot_password(){

        $this->user_model->set_validation('forgot_pass');
        if ($this->user_model->validate(data_post(['email'])) == FALSE) {
            $this->session->set_flashdata('m', validation_errors());
        }else{
            if($p = $this->user_model->change_pass($this->input->post('email'))){
                if($this->_send_email($this->input->post('email'), $p)){
                    $this->session->set_flashdata('m', 'The email has been sent to '.$this->input->post('email'));
                }else{
                    $this->session->set_flashdata('message', 'Could not sent the email!');
                }
            }else{
                $this->session->set_flashdata('m', 'Problem setting new password. Please try again!');
            }
        }
    }
    //callback
    public function _validate_email(){

        if($this->user_model->email_exist($this->input->post('email'))){
            return true;
        }else{
            $this->form_validation->set_message('_validate_email', 'This email is not registered');
            return false;
        }
    }

    public function _send_email($email, $p){

        $this->load->library('email', ['mailtype' => 'html']);
        $this->email->from('www.embassy-pub.ro', 'Traian');
        $this->email->to($email);
        $this->email->subject('Password recover');
        $message = "<p>Your new passowrd is ".$p.". </p>";
        $message .= "<p><a href='".base_url()."'>Click here</a> to sign in using the password provided</p>"; 
        $this->email->message($message);
        return $this->email->send() ? true : false;
    }

    public function change_password(){

        $user_id = $this->session->userdata('id') != $this->uri->segment(3) ?
                $this->session->userdata('id') : $this->session->userdata('id');
        $this->user_model->set_validation('password');
        if($this->user_model->validate(data_post(['old_password', 'password'])) === FALSE){
            $this->session->set_flashdata('m', validation_errors());
        }else{
            $new_pass = $this->user_model->encrypt_pass($this->input->post('password'));
            if ($this->user_model->update($user_id, ['password' => $new_pass], TRUE)){
                $this->session->set_flashdata('m', '<p>Saved</p>');
                redirect('auths/user/' . $user_id);
            }else{
                $this->session->set_flashdata('m', 'Problem saving password');
            }
        }
    }
    //calback
    public function _validate_old_pass(){

        $this->db->where('id', $this->session->userdata('id'));
        $result = $this->db->get('users');
        if($result->row(2)){//cond if when use it like callback (ci)
            $db_password = $result->row(2)->password;
            if(password_verify($this->input->post('old_password'), $db_password)){
                return true;
            } else {
                $this->form_validation->set_message('_validate_old_pass', 'Password is not correct');
                return false;
            }
        }else{
            $this->form_validation->set_message('_validate_old_pass', 'Password missing');
            return false;
        }
    }

    public function log_out(){
        $this->session->sess_destroy();
        redirect('auths');
    }

    public function delete_account(){
        
        if($this->user_model->delete($this->session->userdata('id'))){
            $this->log_out();
        }else{
            $this->session->set_flashdata('m', 'Problem deleting this account. Please try later!');
        }
    }

    public function test(){

    }

}