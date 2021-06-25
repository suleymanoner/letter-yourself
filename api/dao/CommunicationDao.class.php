<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class CommunicationDao extends BaseDao{

  public function __construct(){
    parent::__construct("communication");
  }

  public function get_receiver_id_by_letter_id($letter_id) {
    return $this->query_unique("SELECT receiver_id FROM communication WHERE letter_id = :id", ["id" => $letter_id]);
  }

  public function get_communication($account_id){

    $params = [];

    $query = "SELECT *
              FROM communication
              WHERE 1 = 1 ";

    if ($account_id){
      $params["account_id"] = $account_id;
      $query .= "AND account_id = :account_id ";
    }

    return $this->query($query, $params);
  }

}

?>
