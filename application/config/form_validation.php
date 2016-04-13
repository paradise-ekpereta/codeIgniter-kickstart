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
        ),
        'category' => array(
                array(
                        'field' => 'name',
                        'label' => 'Category name',
                        'rules' => 'required|max_length[255]'
                ),
                array(
                        'field' => 'category_order',
                        'label' => 'Order',
                        'rules' => 'required|numeric'
                )
        ),
        'article' => array(
                array(
                        'field' => 'title',
                        'label' => 'Article title',
                        'rules' => 'required|max_length[255]'
                ),
                array(
                        'field' => 'category',
                        'label' => 'Category',
                        'rules' => 'required|numeric'
                ),
                array(
                        'field' => 'content',
                        'label' => 'Article Body',
                        'rules' => 'required'
                )
        ),
        'page' => array(
                array(
                        'field' => 'title',
                        'label' => 'Page title',
                        'rules' => 'required|max_length[255]'
                ),
                array(
                        'field' => 'name',
                        'label' => 'Menu name',
                        'rules' => 'required|max_length[100]'
                ),
                array(
                        'field' => 'status',
                        'label' => 'Status',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'content',
                        'label' => 'Page Body',
                        'rules' => 'required'
                )
        ),
        'admin/settings' => array(
                array(
                        'field' => 'test',
                        'label' => 'All fields',
                        'rules' => 'required'
                )
        )
);