<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class LetterDao extends BaseDao{

  public function __construct(){
    parent::__construct("letter");
  }


  // THERE IS PROBLEM HERE, FIND IT

  public function get_letter($account_id, $offset, $limit, $search, $order){

    list($order_column, $order_direction) = self::parse_order($order);

    $params = ["account_id" => $account_id];
    $query = "SELECT * FROM letter
              WHERE account_id = :account_id ";

    if(isset($search)){
      $query .= "AND ( LOWER(title) LIKE CONCAT('%', :search, '%') OR send_date LIKE CONCAT('%', :search, '%')) ";
      $params['search'] = strtolower($search);
    }

    // when disable order, it doesn't work. Check on internet.
    $query .= "ORDER BY ${order_column} ${order_direction} ";
    $query .= "LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query, $params);
  }


  public function get_letter5($account_id, $offset, $limit, $search, $order){

    list($order_column, $order_direction) = self::parse_order($order);
    $params = [];

    $query2 = "SELECT letter.id, letter.title, letter.body, letter.photograph, letter.created_at, letter.send_at
               FROM letter
               JOIN communication ON letter.id = communication.letter_id
               WHERE 1 = 1 ";


    if ($account_id){
      $params["communication.account_id"] = $account_id;
      $query2 .= "AND communication.account_id = :account_id ";
    }


    if (isset($search)){
      $query2 .= "AND ( LOWER(title) LIKE CONCAT('%', :search, '%') OR LOWER(send_at) LIKE CONCAT('%', :search, '%')) ";
      $params['search'] = strtolower($search);
    }

    $query2 .="ORDER BY ${order_column} ${order_direction} ";
    $query2 .="LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query2, $params);
  }

}



?>
