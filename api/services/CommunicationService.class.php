<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/CommunicationDao.class.php';

class CommunicationService extends BaseService{

  public function __construct(){
    $this->dao = new CommunicationDao();
  }

  public function add_communication($letter_id, $receiver_id, $account_id){
    try {
      $data = [
        "letter_id" => $letter_id['id'],
        "receiver_id" => $receiver_id['id'],
        "account_id" => $account_id
      ];
      return parent::add($data);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function get_receiver_id_by_letter_id($letter_id){
    return $this->dao->get_receiver_id_by_letter_id($letter_id);
  }

  public function get_all($account_id, $offset, $limit){
    $comm_array = $this->dao->get_comm_new($account_id, $offset, $limit);
    $array = array();

    for($i = 0 ; $i< sizeof($comm_array) ; $i++){

      $receiver = $comm_array[$i];
      $receiver_id = $receiver['receiver_id'];
      $letter_id = $receiver['letter_id'];
      $letter_title = Flight::letterService()->get_letter_title_by_id($letter_id);
      $receiver_email_array = Flight::receiverService()->get_receiver_email_with_id($receiver_id);
      $receiver_email = $receiver_email_array['receiver_email'];

      $array[$i]['letter_title'] = $letter_title['title'];
      $array[$i]['email'] = $receiver_email;
    }

    return $array;
  }

}

?>
