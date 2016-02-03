<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_model extends CI_Model
{
    protected $smsApi;
    protected $username;
    protected $password;
    protected $type;

    public function __construct()
    {
        parent::__construct();
        $this->initGatewayData();
    }
    public function initGatewayData()
    {
        $this->load->database();
        $sql = $this->db->query("SELECT * FROM sms_gateways WHERE status='active'");
        $row = $sql->row();
        $this->username = $row->username;
        $this->password = $row->password;
        $this->type = $row->type;
    }
    public function addAccount($id)
    {
        $trialsms = 0;
        if(!empty($this->option_model->get('trial_sms')))
        {
            $trialsms = $this->option_model->get('trial_sms');
        }
        $DB = $this->tenants_model->getDB();
        $sql = $DB->query("INSERT INTO sms_accounts SET user_id='$id',balance='$trialsms'");
        if($sql)
        {
            return true;
        }
    }
    public function accountbalance($id)
    {
      $balance = 0;
        if(!$this->tenants_model->isVendor())
        {
            $this->load->model('auth_model');
            $db = $this->tenants_model->getDB();
            $query = $db->query("SELECT * FROM users WHERE id='$id'");
            $row = $query->row();
            if($row->account_type == 'admin')
            {
                $slug = $this->tenants_model->getSlugOrDomain();
                $tenant = $this->tenants_model->getTenant($slug);
                $user = $tenant->owner_id;
                $DB = $this->load->database('vendor',TRUE);
                $sql = $DB->query("SELECT balance FROM sms_accounts WHERE user_id='$user' ");
                $count =  $sql->num_rows();
                if($count == 1)
                {
                    $row = $sql->row();
                    $balance = $row->balance;
                }
            }
            else
            {
              $DB = $this->tenants_model->getDB();
              $sql1 = $DB->query("SELECT balance FROM sms_accounts WHERE user_id='$id' ");
              $count =  $sql1->num_rows();
              if($count == 1)
              {
                  $row = $sql1->row();
                  $balance = $row->balance;
              }
            }
        }
        else
        {
          $sql = $this->db->query("SELECT balance FROM sms_accounts WHERE user_id='$id' ");
          $count =  $sql->num_rows();
          if($count == 1)
          {
              $row = $sql->row();
              $query = $this->db->query("SELECT account_type FROM users WHERE id='$id'");
              $data = $query->row();
              if($data->account_type == 'admin')
              {
                $balance = $this->getGatewayAccountBalance();
              }
              else
              {
                $balance = $row->balance;
              }
          }
        }
        return $balance;
    }
    protected function accountExists($id)
    {
        $DB = $this->tenants_model->getDB();
        $sql = $DB->query("SELECT * FROM sms_accounts WHERE user_id='$id'");
        $count = $sql->num_rows();
        if($count == 1)
        {
            return true;
        }
    }
    public function credit($id,$amount)
    {
        $DB = $this->tenants_model->getDB();
        $sql = $DB->query("SELECT * FROM sms_accounts WHERE user_id='$id'");
        $count = $sql->num_rows();
        if($count != 1)
        {
            return false;
        }
        if(!$this->tenants_model->isVendor())
        {
            //$ownerId = $this->session->userdata('id');
            if(!$this->debitTenant($amount))
            {
                return false;
            }
        }
        $row = $sql->row();
        $newBalance = $row->balance + $amount;
        $query = $DB->query("UPDATE sms_accounts SET balance='$newBalance' WHERE user_id='$id'");
        if($sql)
        {
            return true;
        }
    }
    public function debit($id,$amount)
    {
        if(!$this->tenants_model->isVendor())
        {
            if($this->auth_model->user()->account_type == 'admin')
            {
                if($this->debitTenant($amount))
                {
                    return true;
                }
            }
        }
        if($this->auth_model->user()->account_type == 'admin')
        {
            return true;
        }
        else
        {
          $DB = $this->tenants_model->getDB();
          $sql = $DB->query("SELECT * FROM sms_accounts WHERE user_id='$id'");
          $count = $sql->num_rows();
          if($count != 1)
          {
              return false;
          }
          if($this->Accountbalance($id) > $amount)
          {
              $row = $sql->row();
              $newBalance = $row->balance - $amount;
              $query = $DB->query("UPDATE sms_accounts SET balance='$newBalance' WHERE user_id='$id'");
              if($sql)
              {
                  return true;
              }
          }
        }
    }
    public function debitTenant($amount)
    {
        $DB = $this->load->database('vendor',true);
        $slug = $this->tenants_model->getSlugOrDomain();
        $tenantdb = $this->tenants_model->getTenant($slug);
        $id = $tenantdb->owner_id;
        $sql = $DB->query("SELECT * FROM sms_accounts WHERE user_id='$id'");
        $count = $sql->num_rows();
        if($count != 1)
        {
            return false;
        }
        $tenant = $sql->row();
        if($tenant->balance > $amount)
        {
            $balance = $tenant->balance;
            $newBalance =  $balance - $amount;
            $query = $DB->query("UPDATE sms_accounts SET balance='$newBalance' WHERE user_id='$id'");
            if($sql)
            {
                return true;
            }
        }
    }
    public function creditTenant($amt)
    {
        $DB = $this->load->database('vendor',true);
        $slug = $this->tenants_model->getSlugOrDomain();
        $tenantdb = $this->tenants_model->getTenant($slug);
        $id = $tenantdb->owner_id;
        $sql = $DB->query("SELECT * FROM sms_accounts WHERE user_id='$id'");
        $count = $sql->num_rows();
        if($count != 1)
        {
            return false;
        }
        $tenant = $sql->row();
        $balance = $tenant->balance;
        $newBalance =  $balance + $amt;
        $query = $DB->query("UPDATE sms_accounts SET balance='$newBalance' WHERE user_id='$id'");
        if($sql)
        {
          return true;
        }
    }
    public function getGatewayAccountBalance()
    {
      $balance = 0;
      if($this->type == 'infobip')
      {
        try
        {
          $client = new infobip\api\client\GetAccountBalance(new infobip\api\configuration\BasicAuthConfiguration($this->username, $this->password));
          $response = $client->execute();
          $balance = $response->getBalance() . ' ' . $response->getCurrency();
        } catch (Exception $e)
        {
          $balance = 0;
        }
      }
      return $balance;
    }
    public function send($to,$from,$msg,$type=0)
    {
      $isTenant = false;
      $numbers = explode(',', $to);
      $contacts = count($numbers);
      $prefix = '234';
      foreach ($numbers as $key => $value) {
        if(strlen($value) == 11 && $value[0] == 0)
        {
          $value = ltrim($value,'0');
          $value = $prefix.$value;
          $numbers[$key] = $value;
        }
      }
      $id = $this->session->userdata('id');
      $rate = $this->option_model->get('sms_rule');
      $msg_length = strlen($msg);
      $msg_count = floor($msg_length / 160);
      if(($msg_length % 160) != 0)
      {
        $msg_count = floor($msg_length / 160) + 1;
      }
      $qty = ($rate * $msg_count) * $contacts;
      if(!$this->tenants_model->isVendor())
      {
        $isTenant = true;
        //calculating reseller buying rate
        $r = $this->tenants_model->vendorOption('reseller_rate');
        $r_qty = ($r * $msg_count) * $contacts;
        $reseller_profit = $qty - $r_qty;
        if(!$this->wallet_model->creditTenant($reseller_profit))
        {
          $this->flash->overlay("Unknown host error has occurred, please try again.");
          return false;
        }
      }
      if(!$this->debit($id,$qty))
      {
        if($isTenant == true)
        {
          $this->wallet_model->debitTenant($reseller_profit);
        }
        $this->flash->overlay("You do not have sufficient sms unit to complete this action","Insufficient sms unit");
        return false;
      }
      if($isTenant == true)
      {
        $this->wallet_model->logWalletTransaction([
                                                                'amount' => $reseller_profit,
                                                                'user_id' => $this->wallet_model->getTenantId(),
                                                                'status' => 'completed',
                                                                'pay_method' => 'system',
                                                                'pay_type' => 'RESELLER_EARNINGS',
                                                                'description' => 'Your user sent a voice message'
                                                              ]);
      }
      //connect to the database
      $DB = $this->tenants_model->getDB();
      if($this->type == 'infobip')
      {
        try
        {
          $destinations = [];
          $client = new infobip\api\client\SendMultipleTextualSmsAdvanced(new infobip\api\configuration\BasicAuthConfiguration($this->username, $this->password));

          foreach ($numbers as $key => $number) {
            $key = new infobip\api\model\Destination();
            $key->setTo($number);
            $destinations[] = $key;
          }
          $message = new infobip\api\model\sms\mt\send\Message();
          $message->setFrom($from);
          $message->setDestinations($destinations);
          $message->setText($msg);
          if($type == 1)
          {
            $message->setFlash(true);
          }
          $message->setNotifyUrl(site_url("reports/sms_delivery_reports"));

          $requestBody = new infobip\api\model\sms\mt\send\textual\SMSAdvancedTextualRequest();
          $requestBody->setMessages([$message]);

          // Executing request
          $response = $client->execute($requestBody);

          $sentMessageInfo = $response->getMessages();
          foreach ($sentMessageInfo as $resp) {
            $msg_id = $resp->getMessageId();
            $to = $resp->getTo();
            $status = $resp->getStatus()->getName();
            $DB->query("INSERT INTO
                                    sent_messages
                                    SET
                                      msg_id='$msg_id',
                                      contact='$to',
                                      status='DELIVERED',
                                      user_id='$id',
                                      sender_id='$from',
                                      count='$msg_count',
                                      msg='$msg',
                                      sent_at=now()
                                  ");
          }
          $this->flash->overlay("Your sms was sent successfully","sms sent");
        }
        catch(Exception $e)
        {
          //echo $e->getMessage();
          $this->flash->overlay("Oops An unknown error occurred check your internet connection and try again.","Error Occurred");
        }
      }
    }
    public function sendVoice($to,$from,$msg,$voice=false,$wait=false)
    {
      $isTenant = false;
      $numbers = explode(',', $to);
      $contacts = count($numbers);
      $prefix = '234';
      foreach ($numbers as $key => $value) {
        if(strlen($value) == 11 && $value[0] == 0)
        {
          $value = ltrim($value,'0');
          $value = $prefix.$value;
          $numbers[$key] = $value;
        }
      }
      $to = implode(',',$numbers);
      //exit();
      $id = $this->session->userdata('id');
      $rate = $this->option_model->get('credit_per_voice');
      if($voice == false)
      {
        $msg_length = strlen($msg);
        $msg_count = floor($msg_length / 700);
        if(($msg_length % 700) != 0)
        {
          $msg_count = floor($msg_length / 700) + 1;
        }
      }
      else
      {
        $audio = $this->messaging_model->getAudio($id);
        $msg_length = $audio->duration;
        $msg_count = floor($msg_length / 60);
        if(($msg_length % 60) != 0)
        {
          $msg_count = floor($msg_length / 60) + 1;
        }
      }
      $qty = ($rate * $msg_count) * $contacts;
      if(!$this->tenants_model->isVendor())
      {
        $isTenant = true;
        //calculating reseller buying rate
        $r = $this->tenants_model->vendorOption('reseller_credit_per_voice');
        $r_qty = ($r * $msg_count) * $contacts;
        $reseller_profit = $qty - $r_qty;
        if(!$this->wallet_model->creditTenant($reseller_profit))
        {
          $this->flash->overlay("Unknown host error has occurred, please try again.");
          return false;
        }
      }
      if(!$this->debit($id,$qty))
      {
        if($isTenant == true)
        {
          $this->wallet_model->debitTenant($reseller_profit);
        }
        $this->flash->overlay("You do not have sufficient sms unit to complete this action","Insufficient sms unit");
        return false;
      }
      if($isTenant == true)
      {
        $this->wallet_model->logWalletTransaction([
                                                                'amount' => $reseller_profit,
                                                                'user_id' => $this->wallet_model->getTenantId(),
                                                                'status' => 'completed',
                                                                'pay_method' => 'system',
                                                                'pay_type' => 'RESELLER_EARNINGS',
                                                                'description' => 'Your user sent a voice message'
                                                              ]);
      }
      //connect to the database
      $DB = $this->tenants_model->getDB();
      if($this->type == 'infobip')
      {
        $this->load->library(['infobip']);
        $response = $this->infobip->sendVoiceSms($to,$from,$msg,$voice,"en",$wait);
        $json = json_decode($response,true);
        $bulkid = $json['ttsCallRequestBulkId'];
        for ($i = 0; $i < count($json['ttsCallStatuses']); $i++) {
          $description = $json['ttsCallStatuses'][$i]['description'];
          $msgid = $json['ttsCallStatuses'][$i]['ttsCallRequestId'];
          $status = $json['ttsCallStatuses'][$i]['status'];
          $data = [
            'user_id' => $id,
            'status' => $status,
            'msg_id' => $msgid,
            'bulk_id' => $bulkid,
            'description' => $description
          ];
          $DB->insert('sent_voice',$data);
        }
        $this->flash->overlay("Your voice message was sent successfully","message sent");
      }
    }
    public function systemSend($to,$from,$msg,$type=0)
    {
      $numbers = explode(',', $to);
      $prefix = '234';
      foreach ($numbers as $key => $value) {
        if(strlen($value) == 11 && $value[0] == 0)
        {
          $value = ltrim($value,'0');
          $value = $prefix.$value;
          $numbers[$key] = $value;
        }
      }
      try
        {
          $destinations = [];
          $client = new infobip\api\client\SendMultipleTextualSmsAdvanced(new infobip\api\configuration\BasicAuthConfiguration($this->username, $this->password));

          foreach ($numbers as $key => $number) {
            $key = new infobip\api\model\Destination();
            $key->setTo($number);
            $destinations[] = $key;
          }
          $message = new infobip\api\model\sms\mt\send\Message();
          $message->setFrom($from);
          $message->setDestinations($destinations);
          $message->setText($msg);
          if($type == 1)
          {
            $message->setFlash(true);
          }
          $message->setNotifyUrl(site_url("reports/sms_delivery_reports"));

          $requestBody = new infobip\api\model\sms\mt\send\textual\SMSAdvancedTextualRequest();
          $requestBody->setMessages([$message]);

          // Executing request
          $response = $client->execute($requestBody);
          //$this->flash->overlay("Your sms was sent successfully","sms sent");
        }
        catch(Exception $e)
        {
          //echo $e->getMessage();
          //$this->flash->overlay("Oops An unknown error occurred check your internet connection and try again.","Error Occurred");
        }
    }
    public function systemVoice($to,$from,$msg,$voice=false,$wait=false)
    {
      $numbers = explode(',', $to);
      $prefix = '234';
      foreach ($numbers as $key => $value) {
        if(strlen($value) == 11 && $value[0] == 0)
        {
          $value = ltrim($value,'0');
          $value = $prefix.$value;
          $numbers[$key] = $value;
        }
      }
      $to = implode(',',$numbers);
      $this->load->library(['infobip']);
      $response = $this->infobip->sendVoiceSms($to,$from,$msg,$voice,"en",$wait);
    }
}

?>
