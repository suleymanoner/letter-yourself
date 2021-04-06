<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/CommunicationDao.class.php';

class CommunicationService extends BaseService{

  public function __construct(){
    $this->dao = new CommunicationDao();
  }


  public function add_communication($letter_id, $receiver_id){
    try {
      $data = [
        "letter_id" => $letter_id['id'],
        "receiver_id" => $receiver_id['id']
      ];
      return parent::add($data);
    } catch (\Exception $e) {
      throw $e;
    }
  }





}




?>
