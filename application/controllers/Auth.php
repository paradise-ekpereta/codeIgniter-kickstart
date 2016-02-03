<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function login()
    {
        if($this->auth_model->loggedIn())
        {
            //take the user home
            redirect('/');
        }
        if($this->form_validation->run('login') == FALSE)
        {
            $data['page_title'] = "Login Area";
            $this->load->view('layouts/header',$data);
            $this->load->view('auth/login');
            $this->load->view('layouts/footer');
        }
        else
        {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));

            if($this->auth_model->login($email,$password))
            {
                redirect('/messaging/compose');
            }
            else
            {
                $data['page_title'] = "Login Area";
                $this->load->view('layouts/header',$data);
                $this->load->view('auth/login',$data);
                $this->load->view('layouts/footer');
            }
        }
    }
    public function verify($token)
    {
        $this->load->model('user_model');
        if($this->user_model->verifyEmail($token) == true)
        {
            $this->flash->overlay('Your email verification was successful and your account has been activated.');
        }
        else if($this->user_model->verifyEmail($token) == false)
        {
            $this->flash->overlay('oops an error occurred. unable to verify your email address please try again');
        }
        else
        {
            $this->flash->overlay('Your email address has already been verified');
        }
        redirect('/');
    }
    public function register()
    {
        if($this->auth_model->loggedIn())
        {
            //take the user home
            redirect('/');
        }
        if($this->form_validation->run('signup') == FALSE)
        {
            $data['page_title'] = "Create Account";
            $this->load->view('layouts/header',$data);
            $this->load->view('auth/register');
            $this->load->view('layouts/footer');
        }
        else
        {
            $this->load->model('user_model');
            if($this->user_model->create())
            {
                $this->flash->overlay('Your account was created successfully. A message has been sent to your email address.');
                redirect('/');
            }
            else
            {
                $this->load->view('layouts/header',$data);
                $this->load->view('auth/register',$data);
                $this->load->view('layouts/footer');
            }
        }
    }
    public function logout()
    {
        $this->auth_model->logout();
        redirect('/');
    }
}