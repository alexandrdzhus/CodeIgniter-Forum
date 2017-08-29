<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller
{
    var $views = array();
    var $content = "";
    var $header = null;
    var $menu = null;
    var $footer = null;

    function __construct()
    {
        parent::__construct();

        $this->load->library('Aauth');
        $this->load->library('Aauth_library');

        $this->views = array(
            'header' => 'header',
            'content' => '',
            'menu' => 'menu',
            'footer' => 'footer'
        );
    }

    function display($content, $data)
    {


        $privileges = [
            'is_admin' => $this->aauth_library->is_admin(true),
            'is_loggedin' => $this->aauth_library->is_loggedin(true),
        ];

        $this->header = isset($data['header']) ? $data['header'] : $this->load->view('header', array(), true);
        $this->menu = isset($data['menu']) ? $data['menu'] : $this->load->view('menu', $privileges, true);
        $this->content = isset($content) ? $this->load->view($content, $data, true) : '';
        $this->footer = isset($data['footer']) ? $data['footer'] : $this->load->view('footer', array(), true);

        $data = array_merge(
            $data =
            [
                'header' => $this->header,
                'menu' => $this->menu,
                'content' => $this->content,
                'footer' => $this->footer,

            ],
            $privileges);

        $this->load->view('base_view', $data, false);


    }
}

//    function is_admin($return = false)
//    {
//
//        if ($this->aauth->is_member('Admin')) {
//            if ($return) {
//                return true;
//            }
//        } else {
//            if ($return) {
//                return false;
//            }
//
//            $is_ajax = $this->input->is_ajax_request();
//            if ($is_ajax) {
//                $result = ['error' => true,
//                    'code' => -1,
//                    'message' => "ok!",
//                    'result' => ['html' => '',
//                        'errors' => ''],];
//                echo json_encode($result);
//                die();
//            } else {
//                show_404();
//            }
//        }
//    }
//
//    function is_loggedin($return = false)
//    {
//
//        if (!empty($this->aauth->is_loggedin())) {
//            if ($return) {
//                return true;
//            }
//        } else {
//            if ($return) {
//                return false;
//            }
//
//            $is_ajax = $this->input->is_ajax_request();
//
//            if ($is_ajax) {
//                $result = [
//                    'error' => true,
//                    'code' => -1,
//                    'message' => "ok!",
//                    'result' => [
//                        'html' => '',
//                        'errors' => ''
//                    ],
//                ];
//                echo json_encode($result);
//                die();
//            } else {
//                show_404();
//            }
//        }
//    }
//}


//    function old_is_admin(){
//        $a = $this->session->userdata('logged_in');
//        if (isset($a['role']) && $a['role'] == 'admin') {
//
//        }else {
//           $is_ajax = $this->input->is_ajax_request();
//           if($is_ajax){
//               $result = [
//                   'error' => true,
//                   'code' => -1,
//                   'message' => "ok!",
//                   'result' => [
//                       'html' => '',
//                       'errors' => ''
//                   ],
//               ];
//               echo json_encode($result);
//               die();
//           }else{
//               show_404();
//           }
//        }
//    }
//
//    function old_is_logged_in(){
//
//        if(!empty($this->session->userdata('logged_in'))) {
//
//        }else {
//            $is_ajax = $this->input->is_ajax_request();
//            if($is_ajax){
//                $result = [
//                    'error' => true,
//                    'code' => -1,
//                    'message' => "ok!",
//                    'result' => [
//                        'html' => '',
//                        'errors' => ''
//                    ],
//                ];
//                echo json_encode($result);
//                die();
//            }else{
//                show_404();
//            }
//        }
//    }
//}