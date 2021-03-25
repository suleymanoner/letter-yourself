<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class LetterDao extends BaseDao{

  public function __construct(){
    parent::__construct("letter");
  }

  public function get_letter($person_to_sent_id, $offset, $limit, $search, $order){

    list($order_column, $order_direction) = self::parse_order($order);

    $params = ["person_to_sent_id" => $person_to_sent_id];
    $query = "SELECT * FROM letter
              WHERE person_to_sent_id = :person_to_sent_id ";

    if(isset($search)){
      $query .= "AND LOWER(title) LIKE CONCAT('%', :search, '%') OR send_date LIKE CONCAT('%', :search, '%') ";
      $params["search"] = strtolower($search);
    }

    // when disable order, it doesn't work. Check on internet.
    $query .= "ORDER BY ${order_column} ${order_direction} ";
    $query .= "LIMIT ${limit} OFFSET ${offset}";



    return $this->query($query, $params);
  }

}


?>
