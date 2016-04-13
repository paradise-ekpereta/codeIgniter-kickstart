<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
{
    public function create()
    {
        $fields = [
            'name' => $this->input->post('name'),
            'cat_order' => $this->input->post('category_order')
        ];
        if($this->db->insert('categories',$fields))
        {
            return true;
        }
    }
    public function update($id)
    {
        $name = $this->input->post('name');
        $order = $this->input->post('category_order');

        $sql = $this->db->query("UPDATE categories SET name='$name',cat_order='$order' WHERE id='$id'");
        if($sql)
        {
            return true;
        }
    }
    public function delete($id)
    {
        $sql = $this->db->query("SELECT * FROM articles WHERE category_id='$id'");
        $result = $sql->result();
        foreach ($result as $article) {
            $sql = $this->db->query("DELETE FROM articles WHERE id='".$article->id."'");
        }
        $query = $this->db->query("DELETE FROM categories WHERE id='$id'");
        if($query)
        {
            return true;
        }
    }
    public function getCategories()
    {
        $sql = $this->db->query("SELECT * FROM categories ORDER BY cat_order");
        $result = $sql->result();
        return $result;
    }
    public function getCategory($id)
    {
        $sql = $this->db->query("SELECT * FROM categories WHERE id='$id'");
        $category = $sql->row();
        return $category;
    }
}