<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class LetterDao extends BaseDao{

  public function __construct(){
    parent::__construct("letter");
  }

}

?>
