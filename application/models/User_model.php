<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        //$this->load->library('passwordHash');
    }
    public function find($id)
    {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('id',$id);
        $sql = $this->db->get();
        return $sql->row();
    }
    public function findAll()
    {
        $sql = $this->db->query("SELECT * FROM users ORDER BY id DESC");
        return $sql->result();
    }
    public function create()
    {
        $data = [
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'country' => $this->input->post('country'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'password' => $this->password->HashPassword($this->input->post('password')),
                'account_type' => 'standard',
                'status' => 'inactive'
            ];
        if($this->db->insert('users',$data))
        {
            $id = $this->db->insert_id();
            $sql = $this->db->query("UPDATE users SET created_at=now()");
            return true;
        }
    }
    public function save(Array $data,$id =0)
    {
        if($id == 0)
        {
            $id = $this->auth_model->user()->id;
        }
        $this->db->where('id',$id);
        if($this->db->update('users',$data))
        {
            return true;
        }
    }
    public function changePassword(Array $data,$id =0)
    {
        if($id == 0)
        {
            $id = $this->auth_model->user()->id;
        }
        $current_pwd = md5($data['current_pwd']);
        $pwd = md5($data['pwd']);
        $sql =  $this->db->query("SELECT id FROM users WHERE id='$id' AND password='$current_pwd'");
        $count = $sql->num_rows();
        if($count == 1)
        {
            $info = ['password'=>$pwd];
            $this->db->where('id',$id);
            if($this->db->update('users',$info))
            {
                return true;
            }
        }
    }
    public function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('users');
    }
    public function deactivate($id)
    {
        $sql = $this->db->query("UPDATE users SET status='inactive' WHERE id='$id'");
        if($sql)
        {
            return true;
        }
    }
    public function activate($id)
    {
        $sql = $this->db->query("UPDATE users SET status='active' WHERE id='$id'");
        if($sql)
        {
            return true;
        }
    }
    public function image($class,$id=0)
    {
        if($id == 0)
        {
            $id = $this->auth_model->user()->id;
        }
        $user = $this->find($id);
        $file = APP_ROOT.'uploads'.DIRECTORY_SEPARATOR.'profile'.DIRECTORY_SEPARATOR.$user->photo;
        $photo = '/public/img/avatar.jpg';
        if(is_file($file))
        {
            $photo = '/uploads/profile/'.$user->photo;
        }
        return "<img src='".$photo."' class='".$class."'>";
    }
}