<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Base_Controller {
	
	function index()
    {
        $data['keyword']  = $keyword = '';
        $data['sort']     = $sort = 2;
        $data['per_page'] = 5;
        $data['content']  = [];

        $this->display('users_view', $data);
    }

    function pagination()
    {
        $this->load->model('users_model');
        $this->load->library("pagination");

        $page = $this->uri->segment(3);
        $post = $this->input->post();

        $keyword = $this->input->post('keyword','');
        #$keyword = $post['keyword'];
        $sort = $post['sort'];

        $config['base_url'] = base_url() . 'articles/index';
        $config['total_rows'] = $this->users_model->count_users($keyword);
        $config['per_page'] = $post['perPage'];
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 3;
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config['next_link'] = '&gt;';
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        $config["prev_link"] = "&lt;";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='ci-pagination-page-active active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $config["num_links"] = 1;

        $this->pagination->initialize($config);

        $start = ($page - 1) * $config["per_page"];

        $data['content']  = $this->users_model->get_users($config['per_page'], $start, $keyword, $sort);
        $data['per_page'] = $config['per_page'];
        $data['keyword']  = $keyword;
        $data['sort']     = $sort;

        $result           = [
            'html' => $this->load->view('users_body_view', $data, true),
            'errors' => ''
        ];

        echo json_encode($result);
    }

    function del_user(){
        $this->aauth_library->is_admin(true);
        $this->load->model('users_model');
        $u = $this->input->post("user_id");
        $this->users_model->del_user($u);

        $result = [
            'error' => false,
            'code' => 0,
            'message' => "ok!",
            'result' => [
                'html' => '',
                'errors' => ''
            ],
        ];

        echo json_encode($result);
    }

    function get_user(){
        $user = [];
        $this->load->model("users_model");
        $user_id = $this->input->post("user_id");
        $data = $this->users_model->get_user($user_id);
        foreach ($data as $row) {
            $user['firstname'] = $row->firstname;
            $user['lastname'] = $row->lastname;
            $user['sex'] = $row->sex;
            $user['year_of_birth'] = $row->year_of_birth;
            $user['user_id'] = $user_id;
        }
        $data['user'] = $user;
        $data['sex'] = $user['sex'];
        $data['header'] = 'Edit user';
        $data['button'] = 'Edit';

        $result = [
            'error' => false,
            'code' => 0,
            'message' => "ok!",
            'result' => [
                'html' => $this->load->view('users_modal_view', $data, true),
                'errors' => ''
            ],
        ];

        echo json_encode($result);
    }


    function edit_user()
    {
        $updated_data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'sex' => $this->input->post('sex'),
            'year_of_birth' => $this->input->post('year_of_birth'),
        );

        $this->load->model('users_model');
        $n = $this->input->post("user_id");
        $this->users_model->edit_user($n, $updated_data);

        $result = [
            'error' => false,
            'code' => 0,
            'message' => "ok!",
            'result' => [
                'html' => '',
                'errors' => ''
            ],
        ];
        echo json_encode($result);
    }

}