<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        $data['page_title'] = "Admin Dashboard";
        $this->load->view('admin/layouts/header',$data);
        $this->load->view('admin/index');
        $this->load->view('admin/layouts/footer');
    }
    public function login()
    {
        if($this->form_validation->run() == false)
        {
            $data['page_title'] = "Admin Login";
            $this->load->view('admin/login/index',$data);
        }
        else
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            if(!$this->auth_model->adminLogin($email,$password))
            {
                $this->flash->danger('Your email or password is incorrect');
                return redirect('/admin/login');
            }
            $this->flash->success('You are logged In');
            return redirect('/admin');
        }
    }
    public function logout()
    {
        $this->auth_model->logout();
        redirect('/admin/login');
    }
    public function users()
    {
        if(!$this->auth_model->isAdmin())
        {
            return redirect('/admin/login');
        }
        $data['page_title'] = "Manage Users";
        $this->load->view('admin/layouts/header',$data);
        $this->load->view('admin/users/index');
        $this->load->view('admin/layouts/footer');
    }
    public function activate_user($id)
    {
        $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        if(!$this->user_model->activate($id))
        {
            $this->flash->danger("An error occurred. Unable to activate user account at this time");
            return redirect('/admin/users');
        }
        $this->flash->success('User account was activated successfully');
        redirect('/admin/users');
    }
    public function deactivate_user($id)
    {
        $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        if(!$this->user_model->deactivate($id))
        {
            $this->flash->danger("An error occurred. Unable to activate user account at this time");
            return redirect('/admin/users');
        }
        $this->flash->success('User account was deactivated successfully');
        redirect('/admin/users');
    }
    public function delete_user($id)
    {
        $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        if(!$this->user_model->delete($id))
        {
            $this->flash->danger("An error occurred. Unable to delete user account at this time");
            return redirect('/admin/users');
        }
        $this->flash->success('User account was deleted successfully');
        return redirect('/admin/users');
    }

}