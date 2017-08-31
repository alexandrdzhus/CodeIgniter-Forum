<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Base_Controller
{

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('firstname', 'First name', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Last name', 'trim|required');
            $this->form_validation->set_rules('year_of_birth', 'Year of Birth', 'trim|required');
            $this->form_validation->set_rules('username', 'Nick name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Repeat Password', 'trim|required|callback_errors');

            $this->form_validation->set_error_delimiters('<div class="control-label">', '</div>');

            $this->aauth->aauth_db->trans_begin();

            if ($this->form_validation->run()) {
                if ($this->aauth->aauth_db->trans_status() === TRUE) {
                    $this->aauth->aauth_db->trans_commit();
                }
                redirect(site_url('login'), 'refresh');
            }
            if ($this->aauth->aauth_db->trans_status() === FALSE) {
                $this->aauth->aauth_db->trans_rollback();
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
            $data = [
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'year_of_birth' => $this->input->post('year_of_birth'),
                'sex' => $this->input->post('sex'),
                'aauth_users_id' => $result
            ];
            $this->load->model('users_model');
            $result = $this->aauth->aauth_db->insert('user', $data);

            return $result;
        } else {
            $this->form_validation->set_message('errors', implode('<br>',  $this->aauth->get_errors_array()));
            return false;
        }
    }
}
