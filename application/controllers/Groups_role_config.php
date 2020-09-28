<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups_role_config extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('permission_page_group_model');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $groups = $this->permission_page_group_model->get_groups();
        $data['groups'] = $groups;

        $pages = $this->permission_page_group_model->get_pages();
        $data['pages'] = $pages;

        $permissions = $this->permission_page_group_model->fetch_permissions();
        $data['fetchPermission'] = $this->preparePermission($permissions);

        $this->load->view('groups_role_config', $data);
    }

    private function preparePermission($permissions)
    {
        $result = [];
        foreach ($permissions as $permission) {
            $result[$permission->group_id][$permission->page_id] = true;
        }
        return $result;
    }

    public function save()
    {
        if ($this->input->post()) {
            $pages = $this->input->post('pages');
            $group_id = $this->input->post('idGroup');
            $this->permission_page_group_model->clear_group_permissions($group_id);

            if (!empty($pages)) {
                foreach ($pages as $page) {
                    $permissionsData = array(
                        'page_id' => $page,
                        'group_id' => $group_id
                    );
                    $this->permission_page_group_model->set_permissions($permissionsData);
                }
                $res = $this->permission_page_group_model->fetch_permissions();
                echo json_encode($res);
            }
        }
    }
}