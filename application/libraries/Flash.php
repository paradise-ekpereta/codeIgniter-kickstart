<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flash
{
    protected $CI;

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
    }
    public function overlay($msg,$title="Notice")
    {
        $this->CI->session->set_flashdata('overlay-title',$title);
        $this->CI->session->set_flashdata('overlay-message',$msg);
    }
    public function success($msg)
    {
        $this->CI->session->set_flashdata('notice-success',$msg);
    }
    public function danger($msg)
    {
        $this->CI->session->set_flashdata('notice-danger',$msg);
    }
    public function warning($msg)
    {
        $this->CI->session->set_flashdata('notice-warning',$msg);
    }
    public function info($msg)
    {
        $this->CI->session->set_flashdata('notice-info',$msg);
    }
    public function displayFlashMessages()
    {
        if(!empty($this->CI->session->flashdata('notice-success')))
        {
            echo '<div class="alert alert-success">'.$this->CI->session->flashdata('notice-success').'</div>';
        }
        if(!empty($this->CI->session->flashdata('notice-danger')))
        {
            echo '<div class="alert alert-danger">'.$this->CI->session->flashdata('notice-danger').'</div>';
        }
        if(!empty($this->CI->session->flashdata('notice-warning')))
        {
            echo '<div class="alert alert-warning">'.$this->CI->session->flashdata('notice-warning').'</div>';
        }
        if(!empty($this->CI->session->flashdata('notice-info')))
        {
            echo '<div class="alert alert-info">'.$this->CI->session->flashdata('notice-info').'</div>';
        }
        if(!empty($this->CI->session->flashdata('overlay-message')))
        {
            echo '
                <div class="modal fade" id="flash-notice-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">'.$this->CI->session->flashdata("overlay-title").'</h4>
                      </div>
                      <div class="modal-body">
                        '.$this->CI->session->flashdata("overlay-message").'
                      </div>
                    </div>
                  </div>
                </div>';
        }
        if(!empty(validation_errors()))
        {
            echo '
                <div class="modal fade" id="flash-notice-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Fix the following errors</h4>
                      </div>
                      <div class="modal-body">
                        '.validation_errors().'
                      </div>
                    </div>
                  </div>
                </div>';
        }
    }
}