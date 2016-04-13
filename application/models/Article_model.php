<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model
{
    public function create()
    {
        $thumb = '';
        if(!empty($_FILES['thumb']['name']))
        {
            $config['upload_path']          = './uploads/articles/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 5000;
            $config['overwrite']           = true;
            $config['file_name'] = strtotime('now').$_FILES['thumb']['name'];
            $thumb = strtotime('now').$_FILES['thumb']['name'];
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('thumb'))
            {
                $this->flash->danger($this->upload->display_errors());
                return false;
            }
        }
        if($thumb == '')
        {
            return false;
        }
        $fields = [
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'category_id' => $this->input->post('category'),
            'thumb' => $thumb
        ];
        if($this->db->insert('articles',$fields))
        {
            $id = $this->db->insert_id();
            $sql = $this->db->query("UPDATE articles SET created_at=now() WHERE id='$id'");
            if($sql)
            {
                return true;
            }
        }
    }
    public function update($id)
    {
         $thumb = '';
        if(!empty($_FILES['thumb']['name']))
        {
            $config['upload_path']          = './uploads/articles/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 5000;
            $config['overwrite']           = true;
            $config['file_name'] = strtotime('now').$_FILES['thumb']['name'];
            $thumb = strtotime('now').$_FILES['thumb']['name'];
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('thumb'))
            {
                $this->flash->danger($this->upload->display_errors());
                return false;
            }
            $article = $this->getArticle($id);
            @unlink(APP_ROOT.'uploads/articles/'.$article->thumb);
        }
        else
        {
            $article = $this->getArticle($id);
            $thumb = $article->thumb;
        }
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $category = $this->input->post('category');
        $thumb = $thumb;
        $sql = $this->db->query("UPDATE articles SET title='$title',content='$content',category_id='$category',thumb='$thumb' WHERE id='$id'");
        if($sql)
        {
            $query = $this->db->query("UPDATE articles SET updated_at=now() WHERE id='$id'");
            if($query)
            {
                return true;
            }
        }
    }
    public function getArticle($id)
    {
        $sql = $this->db->query("SELECT * FROM articles WHERE id='$id'");
        $article = $sql->row();
        return $article;
    }
    public function getCategoryArticles($id)
    {
        $sql = $this->db->query("SELECT * FROM articles WHERE category_id='$id'");
        $articles = $sql->result();
        return $articles;
    }
    public function getAllArticles()
    {
        $sql = $this->db->query("SELECT * FROM articles ");
        $articles = $sql->result();
        return $articles;
    }
    public function delete($id)
    {
        $article = $this->getArticle($id);
        @unlink(APP_ROOT.'uploads/articles/'.$article->thumb);
        $query = $this->db->query("DELETE FROM articles WHERE id='$id'");
        if($query)
        {
            return true;
        }
    }
}