<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_model extends CI_Model
{
    public function send($to,$msg,$subject)
    {
        $mg = new Mailgun\Mailgun("key-aef6eef0527a56e5826a00fdd9afee3b");
        $domain = "genuine-cars.com";
        $mg->sendMessage($domain, array('from'    => 'noreply@genuine-cars.com',
                                'to'      => $to,
                                'subject' => $subject,
                                'text'    => $msg));
    }
}