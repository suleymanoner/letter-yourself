<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/LetterDao.class.php';


class LetterService extends BaseService{

  public function __construct(){
    $this->dao = new LetterDao();
  }

  public function add($letter){
    try {
      parent::add($letter);
    } catch (\Exception $e) {
      throw $e;
    }
  }


}


?>
