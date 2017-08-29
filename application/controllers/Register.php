<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Base_Controller
{

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Repeat Password', 'trim|required|callback_errors');

            $this->form_validation->set_error_delimiters('<div class="control-label">', '</div>');

            if ($this->form_validation->run()) {
                redirect(site_url('login'), 'refresh');
            }
        }
        $this->display('register_view', '');
    }

    function errors()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $name = $this->input->post('username');

        $result = $this->aauth->create_user($email, $password, $name);

        if ($result) {
            return true;
        } else {
            $this->form_validation->set_message('errors', implode('<br>',  $this->aauth->get_errors_array()));
            return false;
        }
    }
}

//	public function old_index()
//    {
//    	$this->load->library('form_validation');
//
//    	$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
//    	$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
//    	$this->form_validation->set_rules('nickname', 'Nick Name', 'trim|required|is_unique[users.nickname]');
//    	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
//        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]');
//        $this->form_validation->set_rules('passconf', 'Repeat Password', 'trim|required');
//
//        $this->form_validation->set_error_delimiters('<div class="control-label">', '</div>');
//
//        if($this->form_validation->run()==false) {
//
//            $this->load->model('register_model');
//            $data['content'] = '';
//            $this->display('register_view', $data);
//        }
//        else if ($this->input->post('daftar')) {
//                $this->load->model('register_model');
//                $this->register_model->register();
//                redirect(base_url('login'), 'refresh');
//            }
//        else{
//                $data['firstname'] = $this->input->post('firstname');
//                $data['lastname']  = $this->input->post('lastname');
//                $data['nickname']   = $this->input->post('nickname');
//                $data['email']      = $this->input->post('email');
//                $data['password']   = $this->input->post('password');
//
//                $id = $this->users_model->register($data);
//
//                $data = $this->users_model->get_user_info_by_id($id)[0];
//
//                if ($id != null) {
//                $newdata = array(
//                    'nickname'  => $data['nickname'],
//                    'email'     => $data['email'],
//                    'role'      => $data['role'],
//                    'id'        => $data['id'],
//                    'logged_in' => TRUE
//                );
//                $this->session->set_userdata($newdata);
//                $this->session->set_flashdata('message', 'You have successfully registered');
//            }
//                redirect(base_url('login'), 'refresh');
//            }
//    }
//}