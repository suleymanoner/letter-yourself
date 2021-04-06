<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/ReceiverDao.class.php';

class ReceiverService extends BaseService{


  public function __construct(){
    $this->dao = new ReceiverDao();
  }

  public function get_receiver_email_with_id($receiver_id){
    return $this->dao->get_receiver_email_with_id($receiver_id);
  }

  public function add_receiver($receiver){
    try {
      $data = [
        "receiver_email" => $receiver,
      ];
      return parent::add($data);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function get_receiver_id_by_email($receiver_email){
    return $this->dao->get_receiver_id_by_email($receiver_email);
  }

}

?>
