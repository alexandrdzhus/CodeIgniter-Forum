<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {

	function register(){
        $fn = $this->input->post('firstname');
        $ln = $this->input->post('lastname');
        $nn = $this->input->post('nickname');
        $em = $this->input->post('email');
        $pw = md5($this->input->post('password'));

        $data = array(
            'id' => '',
            'firstname' => $fn,
            'lastname' => $ln,
            'nickname' => $nn,
            'email' => $em,
            'password' => $pw
        );
        $this->db->insert('users', $data);
    }
}