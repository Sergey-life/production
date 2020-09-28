<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checking_access_to_pages_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        if ($this->ion_auth->logged_in())
        {
            $url_string = $this->uri->segment(1).'/'.$this->uri->segment(2);
            $this->load->library(['form_validation']);
            $this->load->model('permission_page_group_model');
            $result = $this->permission_page_group_model->get_permission_for_groups();

            $authUrl = 'auth/login';
            $logoutUru = 'auth/logout';

            if ($url_string != $authUrl & $url_string != $logoutUru && !$result)
            {
                if (!$this->input->post())
                {
                    show_error('Error_403. Доступ к странице запрещен!');
                }
            }
        }
    }
}

