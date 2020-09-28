<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_page_group_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
    }

    public function get_groups()
    {
        $query = $this->db->get('groups');
        return $query->result();
    }

    public function get_pages()
    {
        $query = $this->db->get('pages');
        return $query->result();
    }

    public function set_permissions($permissionsData)
    {
       $query = $this->db->insert('page_groups', $permissionsData);
       return $query;
    }

    public function fetch_permissions()
    {
        $this->db->select('*');
        $this->db->from('pages');
        $this->db->join('page_groups', 'pages.id = page_groups.page_id', 'inner');
        $this->db->join('groups', 'page_groups.group_id = groups.id', 'inner');
        $query = $this->db->get();
        return $query->result();
    }

    public function clear_group_permissions($group_id)
    {
        $this->db->where("group_id", $group_id);
        return $this->db->delete("page_groups");
    }

    public function get_permission_for_groups()
    {
        $url_string = $this->uri->segment(1).'/'.$this->uri->segment(2);
        $idGroupCurrentUser = $this->ion_auth->get_users_groups()->row()->id;

        $this->db->select('*');
        $this->db->from('pages');
        $this->db->join('page_groups', 'pages.id = page_groups.page_id', 'inner');
        $this->db->where('pages.method_name', $url_string);
        $this->db->where('page_groups.group_id', $idGroupCurrentUser);
        $query = $this->db->get();
        return $query->result();

    }
}