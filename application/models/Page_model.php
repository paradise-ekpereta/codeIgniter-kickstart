<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model
{
    public function create()
    {
        $fields = [
            'name' => $this->input->post('name'),
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'page_order' => $this->input->post('page_order'),
            'status' => $this->input->post('status')
        ];
        if($this->db->insert('pages',$fields)){
            return true;
        }
    }
    public function update($id)
    {
        $name = $this->input->post('name');
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $status = $this->input->post('status');
        $order = $this->input->post('page_order');
        $sql = $this->db->query("UPDATE pages SET name='$name',title='$title',content='$content',status='$status',page_order='$order' WHERE id='$id'");
        if($sql)
        {
            return true;
        }
    }
    public function delete($id)
    {
        $sql = $this->db->query("DELETE FROM pages WHERE id='$id'");
        if($sql)
        {
            return true;
        }
    }
    public function getPage($id)
    {
        $sql = $this->db->query("SELECT * FROM pages WHERE id='$id'");
        $page = $sql->row();
        return $page;
    }
    public function getPages()
    {
        $sql = $this->db->query("SELECT * FROM pages ORDER BY page_order");
        $pages = $sql->result();
        return $pages;
    }
}