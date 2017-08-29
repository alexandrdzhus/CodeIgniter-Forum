<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
    public function register($data)
    {
        if ($data['password'] != null) {
            $data['password'] = md5($data['password']);
        }

        $this->db->insert('users', $data);
        $id = $this->db->insert_id();

        return $id;
    }
   public function is_admin()
    {
        return $this->session->userdata('role') == 'admin';
    }
    public function get_user_info_by_id($user_id)
    {
        $query = $this->db->query('select * from users where id = ?', array($user_id));

        return $query->result_array();
    }
}