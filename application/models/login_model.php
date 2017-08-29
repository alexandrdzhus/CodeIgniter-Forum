<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    function login($email, $password)
    {
        $this->db->select('id,firstname,lastname,nickname,email,password,role');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $this->db->limit(1);

        $query = $this->db->get();
        if($query->num_rows()==1){
            return $query->result();
        }else{
            return false;
        }
    }

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