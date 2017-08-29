<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aauth_library
{
    protected $CI;

    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->library('Aauth');

    }

    function is_loggedin($return = false)
    {

        if (!empty($this->CI->aauth->is_loggedin())) {
            if ($return) {
                return true;
            }
        } else {
            if ($return) {
                return false;
            }
            $is_ajax = $this->CI->input->is_ajax_request();

            if ($is_ajax) {
                $result = [
                    'error' => true,
                    'code' => -1,
                    'message' => "ok!",
                    'result' => [
                        'html' => '',
                        'errors' => ''
                    ],
                ];
                echo json_encode($result);
                die();
            } else {
                show_404();
            }
        }
    }

    function is_admin($return = false)
    {
        if ($this->CI->aauth->is_member('Admin')) {
            if ($return) {
                return true;
            }
        } else {
            if ($return) {
                return false;
            }

            $is_ajax = $this->CI->input->is_ajax_request();
            if ($is_ajax) {
                $result = ['error' => true,
                    'code' => -1,
                    'message' => "ok!",
                    'result' => ['html' => '',
                        'errors' => ''],];
                echo json_encode($result);
                die();
            } else {
                show_404();
            }
        }
    }

    function is_perm($perm_par, $return=false)
    {
        if ($this->CI->aauth->is_allowed($perm_par)) {
            if ($return) {
                return true;
            }
        } else {
            if ($return) {
                return false;
            }

            $is_ajax = $this->CI->input->is_ajax_request();
            if ($is_ajax) {
                $result = ['error' => true,
                    'code' => -2,
                    'message' => "ok!",
                    'result' => ['html' => '',
                        'errors' => ''],];
                echo json_encode($result);
                die();
            } else {
                show_404();
            }
        }
    }
}