<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class LetterDao extends BaseDao{

  public function __construct(){
    parent::__construct("letter");
  }

  public function get_letter($account_id, $offset, $limit, $search, $order){
    list($order_column, $order_direction) = self::parse_order($order);

    $params = [];

    $query = "SELECT *
              FROM letter
              WHERE 1 = 1 ";

    if ($account_id){
      $params["account_id"] = $account_id;
      $query .= "AND account_id = :account_id ";
    }

    if (isset($search)){
      $query .= "AND ( LOWER(title) LIKE CONCAT('%', :search, '%') OR send_at LIKE CONCAT('%', :search, '%'))";
      $params['search'] = strtolower($search);
    }

    $query .="ORDER BY ${order_column} ${order_direction} ";
    $query .="LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query, $params);
  }

  public function get_letter_with_account_and_letter_id($account_id, $id){
    return $this->query_unique("SELECT * FROM letter WHERE account_id = :acc_id AND id = :id", ["acc_id" => $account_id, "id" => $id]);
  }


  public function get_letter_id_by_title($title){
    return $this->query_unique("SELECT id FROM letter WHERE title = :title", ["title" => $title]);
  }



}



?>
