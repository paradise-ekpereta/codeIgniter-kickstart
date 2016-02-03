<?php
defined('BASEPATH') OR exit('No direct script access forbidden');

class Option_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function add($key,$value,$autoload='yes')
    {
        $sql = "INSERT INTO options SET option_key='$key',option_value='$value',autoload='$autoload'";
        if($this->db->query($sql))
        {
            return true;
        }
    }
    public function get($key)
    {
        $sql = $this->db->query("SELECT option_value FROM options WHERE option_key='$key'");
        $count = $sql->num_rows();
        $optin_value = '';
        if($count == 1)
        {
            $data = $sql->row();
            $optin_value = $data->option_value;
        }
        return $optin_value;
    }
    public function set($key,$value='')
    {
        $sql = "UPDATE options SET option_value='$value' WHERE option_key='$key'";
        if($this->db->query($sql))
        {
            return true;
        }
    }
    public function delete($key)
    {
        $sql = "DELETE FROM options WHERE option_key='$key'";
        if($this->db->query($sql))
        {
            return true;
        }
    }
    public function getAll()
    {
        $sql = $this->db->query("SELECT option_value FROM options");
        $result = $sql->result();
        return $result;
    }
}

?>