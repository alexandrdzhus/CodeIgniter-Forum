<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Base_Controller{

	public function index()
    {
        $this->load->model('news_model');

        $data['content'] = '';
        $this->display('news_view', $data);
    }
}