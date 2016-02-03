<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Infobip
{
    protected $CI;

    public function __construct()
    {
        $this->CI = & get_instance();
    }
    public function httpGet($url,$data = [])
    {
        $query = "?";
        foreach ($data as $key => $value) {
            $query .= $key."=".$value."&";
        }
        $query = rtrim($query,"&");
        if(count($data) > 0)
        {
            $url = $url.$query;
        }
        $headers = array(
                         'Content-Type: application/json',
                         'Authorization: Basic '.$this->getAutorization()
                         );
        $ch = curl_init();
        $options = array(
                         CURLOPT_URL => $url,
                         CURLOPT_HTTPHEADER => $headers,
                         CURLOPT_RETURNTRANSFER => 1,
                         );
        curl_setopt_array($ch,$options);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    public function httpPost($url,$data)
    {
        $headers = array(
                         'Content-Type: application/json',
                         'Authorization: Basic '.$this->getAutorization()
                         );
        $ch = curl_init();
        $options = array(
                         CURLOPT_URL => $url,
                         CURLOPT_HTTPHEADER => $headers,
                         CURLOPT_RETURNTRANSFER => 1,
                         CURLOPT_POST => 1,
                         CURLOPT_POSTFIELDS => json_encode($data),
                         );
        curl_setopt_array($ch,$options);
        $output = curl_exec($ch);
        if (!curl_exec($ch))
        {
            // if curl_exec() returned false and thus failed
            echo 'An error has occurred: ' . curl_error($ch);
        }
        curl_close($ch);
        return $output;
    }
    protected function getAutorization()
    {
        return base64_encode('smsalert247:admin//016655');
    }
    public function sendVoiceSms($to,$from,$msg,$audio=false,$lang="en",$waitForDtmf=false)
    {
        $data = [];
        $temp_to = explode(",", $to);
        $url = "http://oneapi.infobip.com/tts/1/requests";
        if(count($temp_to) > 1)
        {
            $url = "http://oneapi.infobip.com/tts/1/bulk/requests";
            $data['destinationAddresses'] = $temp_to;
        }
        else
        {
            $data['destinationAddress'] = $to;
        }
        if($audio == false)
        {
            $data['voiceMessage'] = $msg;
        }
        else
        {
            $data['voiceMessage'] = "Hello, world";
            $data['voiceFileUrl'] = $msg;
        }
        //echo $msg;
        //exit();
        $data['language'] = $lang;
        $data['sourceAddress'] = $from;
        $data['record'] = true;
        $data['retry'] = true;
        if($waitForDtmf == true)
        {
            $data['waitForDtmf'] = true;
        }
        //echo json_encode($data);
        //exit();
        //$data['waitForDtmf'] = true;
        $response = $this->httpPost($url,$data);
        return $response;
        //echo json_encode($data);
        //print_r($response);
        //exit();
    }
    public function getCallStatus($id)
    {
        $response = $this->httpGet("http://oneapi.infobip.com/tts/1/statuses/".$id);
        return $response;
    }
    public function getBulkgetCallStatus($bulk_id)
    {
        $response = $this->httpGet("http://oneapi.infobip.com/tts/1/bulk/statuses/".$bulk_id);
        return $response;
    }
    public function getCallCallDetailRecord($id)
    {
        $response = $this->httpGet("http://oneapi.infobip.com/tts/1/cdrs/".$id);
        return $response;
    }
    public function getBulkCallDetailRecord($bulk_id)
    {
        $response = $this->httpGet("http://oneapi.infobip.com/tts/1/bulk/cdrs/".$bulk_id);
        return $response;
    }
}