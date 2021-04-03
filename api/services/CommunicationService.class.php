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







}




?>
