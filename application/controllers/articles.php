<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['keyword']  = $keyword = '';
        $data['sort']     = $sort = 2;
        $data['per_page'] = 5;
        $data['content']  = [];

        $this->display('articles_view', $data);
    }

     function pagination()
    {
        $this->load->model('articles_model');
        $this->load->library("pagination");

        $page = $this->uri->segment(3);
        $post = $this->input->post();

        $keyword = $post['keyword'];
        $sort = $post['sort'];

        $config['base_url'] = base_url() . 'articles/index';
        $config['total_rows'] = $this->articles_model->count_search($keyword);
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
        $config["num_links"] = 2;

        $this->pagination->initialize($config);

        $start = ($page - 1) * $config["per_page"];

        $data['content']  = $this->articles_model->get_articles($config['per_page'], $start, $keyword, $sort);
        $data['per_page'] = $config['per_page'];
        $data['keyword']  = $keyword;
        $data['sort']     = $sort;

        $result           = [
            'html' => $this->load->view('articles_body_view', $data, true),
            'errors' => ''
        ];

        echo json_encode($result);
    }

    function add_article()
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('text', 'Text', 'trim|required');

        if ($this->form_validation->run() == false) {
            $result = [
                'error' => true,
                'code' => 0,
                'message' => "you have error!",
                'result' => [
                    'html' => '',
                    'errors' => validation_errors()
                ]
            ];
        } else {
            $insert_data = [
                'title' => $this->input->post('title'),
                'text' => $this->input->post('text'),
                'date' => $this->input->post('date'),
                'time' => $this->input->post('time'),
                'author_id' => $this->aauth->CI->session->userdata('id'),
                'editor_id' => $this->aauth->CI->session->userdata('id'),
            ];
            $this->load->model('articles_model');
            $this->articles_model->add_article($insert_data);
            $result = [
                'error' => false,
                'code' => 0,
                'message' => "ok!",
                'result' => [
                    'html' => '',
                    'errors' => validation_errors()
                ],
            ];
        }
        echo json_encode($result);
    }

    function del_article()
    {
        $this->aauth_library->is_admin(true);
        $this->load->model('articles_model');
        $a = $this->input->post("user_id");
        $this->articles_model->del_article($a);

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

    function get_article()
    {
        $article = [];
        $this->load->model("articles_model");
        $article_id = $this->input->post("article_id");
        $data = $this->articles_model->get_article($article_id);
        foreach ($data as $row) {
            $article['title'] = $row->title;
            $article['text'] = $row->text;
            $article['article_id'] = $article_id;
        }
        $data['article'] = $article;
        $data['header'] = 'Edit article';
        $data['button'] = 'Edit';

        $result = [
            'error' => false,
            'code' => 0,
            'message' => "ok!",
            'result' => [
                'html' => $this->load->view('articles_modal_view', $data, true),
                'errors' => ''
            ],
        ];

        echo json_encode($result);


    }

    function get_html_article()
    {
        #$this->aauth_library->is_loggedin(true);
        $this->aauth_library->is_perm('addPost');

        $data['header'] = 'Add article';
        $data['button'] = 'Add';

        $result = [
            'error' => false,
            'code' => 0,
            'message' => "ok!",
            'result' => [
                'html' => $this->load->view('articles_modal_view', $data, true),
                'errors' => ''
            ],
        ];

        echo json_encode($result);
    }


    function edit_article()
    {
        $updated_data = array(
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text'),
            'date' => $this->input->post('date'),
            'time' => $this->input->post('time'),
            'editor_id' => $this->aauth->CI->session->userdata('id'),
        );

        $this->load->model('articles_model');
        $n = $this->input->post("article_id");
        $this->articles_model->edit_article($n, $updated_data);

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