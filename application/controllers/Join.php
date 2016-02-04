<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if($this->auth_model->loggedIn())
        {
            //take the user home
            redirect('/');
        }
    }
    public function index()
    {
        if($this->form_validation->run() == false)
        {
            $this->flash->overlay(validation_errors());
            redirect('/');
        }
        else
        {
            if($this->user_model->create())
            {
                $this->flash->overlay("Your account was created successfully");
            }
            else
            {
                $this->flash->overlay("Ooops Unable to create your account at this time.");
            }
            return redirect('/');
        }
    }
}