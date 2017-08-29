<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Base_Controller
{

    public function index()
    {
        if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_basisdata_cek');

            if ($this->form_validation->run()) {
                redirect(base_url('articles'), 'refresh');
            }
        }
        $this->display('login_view', '');
    }

    function basisdata_cek($password){
        $email = $this->input->post('email');

        if($this->aauth->login($email, $password)){

            return true;
        }else{
            $this->form_validation->set_message('basisdata_cek', 'Invalid email or password');
            return false;
        }
    }

public function logout()
    {
        $this->aauth->logout();
        redirect(site_url('login'),'refresh');
    }
}