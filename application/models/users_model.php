<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }

    function get_users($limit, $offset, $keyword = '', $sort ='')
        // for pagination and first page rendering
    {
        if( !empty($keyword) ){
            $this->db->like('text', $keyword);
        }
        if( !empty($sort) ){
            $this->db->order_by('id', $sort);
        }
        $query = $this->db->get('user', $limit, $offset);
        return $query->result();
    }

    function count_users($keyword)
    {
        $this->db->like('firstname', $keyword);
        $this->db->from('user');
        $query = $this->db->count_all_results();
        return $query;
    }
    function del_user($user_id){
        $this->db->where('id', $user_id);
        $this->db->delete('user');
    }

    function get_user($users_id)
        // for edit user button
    {
        $this->db->where("id", $users_id);
        $query=$this->db->get('user');
        return $query->result();
    }

    function edit_user($user_id, $updated_data){
        $this->db->where('id', $user_id);
        $this->db->update('user',$updated_data);
        return true;
    }
}