<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function __construct()
    {
        $this->load->library('session');
    }
    public function user()
    {
        if(!$this->loggedIn())
        {
            $this->flash->overlay("Ooops, You are not authorized to view that page");
            return false;
        }
        $id = $this->session->userdata('id');
        return $this->user_model->find($id);
    }
    public function login($email,$password)
    {
        $sql = $this->db->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
        $count = $sql->num_rows();
        if($count != 1)
        {
            return false;
        }
        $user = $sql->row();
        $this->session->set_userdata(['id'=>$user->id,'email'=>$user->email]);
        return true;
    }
    public function guest()
    {
        if(!$this->session->has_userdata('id'))
        {
            return true;
        }
    }
    public function loggedIn()
    {
        if($this->session->has_userdata('id') && $this->session->has_userdata('email'))
        {
            return true;
        }
    }
    public function logOut()
    {
        @session_destroy();
    }
}