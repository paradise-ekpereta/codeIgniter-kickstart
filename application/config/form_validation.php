<?php

$config = array(
        'join/index' => array(
                array(
                        'field' => 'firstname',
                        'label' => 'Firstname',
                        'rules' => 'required|max_length[100]'
                ),
                array(
                        'field' => 'lastname',
                        'label' => 'Lastname',
                        'rules' => 'required|max_length[100]'
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required|max_length[15]'
                ),
                array(
                        'field' => 'password_confirmation',
                        'label' => 'Confirm Password',
                        'rules' => 'required|matches[password]'
                ),
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required|valid_email|is_unique[users.email]'
                ),
                array(
                        'field' => 'email_confirmation',
                        'label' => 'Email',
                        'rules' => 'required|valid_email|matches[email]|max_length[120]'
                ),
                array(
                        'field' => 'phone',
                        'label' => 'Phone Number',
                        'rules' => 'required|max_length[15]|numeric|is_unique[users.phone]'
                ),
                array(
                        'field' => 'country',
                        'label' => 'Country',
                        'rules' => 'required|max_length[255]'
                ),
                array(
                        'field' => 'state',
                        'label' => 'State',
                        'rules' => 'required|max_length[255]'
                )

        ),
        'auth/login' => array(
                array(
                        'field' => 'email',
                        'label' => 'Email Address',
                        'rules' => 'required|valid_email'
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required|max_length[15]'
                )
        ),
        'admin/login' => array(
                array(
                        'field' => 'email',
                        'label' => 'Email Address',
                        'rules' => 'required|valid_email'
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required|max_length[15]'
                )
        )
);