<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Test_1 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $this->load->view('test_1');
    }
}