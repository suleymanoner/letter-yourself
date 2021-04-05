<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/CommunicationDao.class.php';

class CommunicationService extends BaseService{

  public function __construct(){
    $this->dao = new CommunicationDao();
  }


  public function get_letterComm($persons_id, $offset, $limit, $search, $order){
    return $this->dao->get_letterComm($persons_id, $offset, $limit, $search, $order);
  }

  public function get_letter_with_persons_id($id){
    return $this->dao->get_letter_with_persons_id($id);
  }


  public function update_letter($person, $id, $letter){
    $db_communication = $this->dao->get_by_id($id);
    //print_r($db_communication); die;
    if($db_communication['account_id'] != $person['aid']){
      return [];
    }
    return $this->update($id, $letter);
  }






}




?>
