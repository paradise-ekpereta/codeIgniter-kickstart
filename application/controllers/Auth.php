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
        if($this->form_validation->run() == FALSE)
        {
            $this->flash->overlay(validation_errors());
        }
        else
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if(!$this->auth_model->login($email,$password))
            {
                $this->flash->overlay("Your email or password is incorrect");
            }
            return redirect('/');
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
    public function logout()
    {
        $this->auth_model->logout();
        redirect('/');
    }
}