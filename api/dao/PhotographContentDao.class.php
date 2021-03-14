<?php
require_once dirname("__FILE__")."/BaseDao.class.php";

class PhotographContentDao extends BaseDao{

  public function __construct(){
    parent::__construct("photograph_content");
  }


}

?>
