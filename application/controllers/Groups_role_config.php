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

        // Отображаем группы и доступные для них странницы
        $accessiblePages = $this->permission_page_group_model->fetch_permissions();
        $data['accessiblePages'] = $this->preparePagesForGroups($accessiblePages);

        $fetchGroupForPages = $this->permission_page_group_model->fetchGroupForPages();

        $fetchPagesForGroup = $this->permission_page_group_model->fetchPagesForGroup();
        $data['pagesForGroup'] = $this->prepare($fetchGroupForPages, $fetchPagesForGroup);
//
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

    private function preparePagesForGroups($accessiblePages)
    {
        $result = [];
        foreach ($accessiblePages as $accessiblePage) {
            $result[$accessiblePage->name][$accessiblePage->permission_description] = $accessiblePage;
        }
        return $result;
    }

    private function prepare($fetchGroupForPages, $fetchPagesForGroup)
    {
        $result = [];

        foreach ($fetchGroupForPages as $fetchGroupForPage) {
            $result[$fetchGroupForPage->id] = $fetchGroupForPage;
        }

        foreach ($fetchPagesForGroup as $fetchPageForGroup) {
            $result[$fetchPageForGroup->parent_id]['pages'][$fetchPageForGroup->id] = $fetchPageForGroup;
        }

//        $groups = [
//            '11' => [
//                'id' => 11,
//                'name' => 'Administration',
//                // И все остальные поля
//                'pages' => [
//                    '1' => [
//                        'id' => 1,
//                        'name' => 'Страница 1',
//                        // Дополнительные поля страницы
//                        'parent_id' => 11,
//                    ],
//                    '2' => [
//                        'id' => 2,
//                        'name' => 'Страница 2',
//                        // Дополнительные поля страницы
//                        'parent_id' => 11,
//                    ],
//                    '4' => [
//                        'id' => 4,
//                        'name' => 'Страница 4',
//                        // Дополнительные поля страницы
//                        'parent_id' => 11,
//                    ],
//                ]
//            ],
//            '12' => [
//                'id' => 12,
//                'name' => 'Group 2',
//                // И все остальные поля
//                'pages' => [
//                    '3' => [
//                        'id' => 3,
//                        'name' => 'Страница 3',
//                        // Дополнительные поля страницы
//                        'parent_id' => 12,
//                    ],
//                ]
//            ],
//        ];
        return $result;
    }

    public function saveOrDeletePermissionForGroup()
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