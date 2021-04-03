<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/LetterDao.class.php';


class LetterService extends BaseService{

  public function __construct(){
    $this->dao = new LetterDao();
  }

  public function add($letter){
    try {
      $letter['created_at'] = date(Config::DATE_FORMAT);
      return parent::add($letter);
    } catch (\Exception $e) {
      throw $e;
    }
  }




  public function get_letter($account_id, $offset, $limit, $search, $order){
    return $this->dao->get_letter($account_id, $offset, $limit, $search, $order);
  }

  public function get_letter5($offset, $limit, $search, $order){
    return $this->dao->get_letter5($offset, $limit, $search, $order);
  }




}

?>
