<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class LetterContentDao extends BaseDao{

  public function __construct(){
    parent::__construct("letter_content");
  }

}

?>
