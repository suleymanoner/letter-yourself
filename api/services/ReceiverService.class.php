<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/ReceiverDao.class.php';

class ReceiverService extends BaseService{


  public function __construct(){
    $this->dao = new ReceiverDao();
  }


}



?>
