<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class PersonToSentDao extends BaseDao{

  public function __construct(){
    parent::__construct("person_to_sent");
  }

}


?>
