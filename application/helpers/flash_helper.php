<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function flash()
{
    $CI = &get_instance();
    $CI->load->model('flash_model');
    $flash = $CI->flash_model;
    return $flash;
}