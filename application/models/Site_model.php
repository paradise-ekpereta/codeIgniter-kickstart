<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_model extends CI_Model
{
    public function updateSettings()
    {
        $counter = 0;
        $options = $this->input->post('option');
        foreach ($options as $key => $value) {
            $this->option_model->set($key,$value);
            $counter++;
        }
        $this->flash->overlay($counter." Settings were updated successfully");
    }
}