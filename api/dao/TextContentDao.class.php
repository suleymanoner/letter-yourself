<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class TextContentDao extends BaseDao{

  public function __construct(){
    parent::__construct("text_content");
  }

}

?>
