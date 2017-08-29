<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Base_Controller {
	
	public function index()
    {
    	$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        if ($this->form_validation->run() == FALSE)
        {
            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['id'] = $session_data['id'];
                $data['firstname'] = $session_data['firstname'];
                $data['lastname'] = $session_data['lastname'];
                $data['nickname'] = $session_data['nickname'];
                $data['email'] = $session_data['email'];
                $this->load->model('users_model');

                $data['content'] = '';
                $this->display('users_view', $data);

            }else{
                redirect('login', 'refresh');
            }
        }else{
            redirect('login', 'refresh');
        }
    }
}