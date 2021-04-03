<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class CommunicationDao extends BaseDao{

  public function __construct(){
    parent::__construct("communication");
  }


  public function get_letterComm($persons_id, $offset, $limit, $search, $order){

    list($order_column, $order_direction) = self::parse_order($order);


    $params2 = ["communication.persons_id" => $persons_id];

    $query2 = "SELECT letter.id, letter.title, letter.body, letter.photograph, letter.created_at, letter.send_at
               FROM letter
               JOIN communication ON letter.id = communication.letter_id
               WHERE communication.persons_id = :persons_id ";



    if(isset($search)){
      $query2 .= "AND ( LOWER(title) LIKE CONCAT('%', :search, '%') OR send_date LIKE CONCAT('%', :search, '%')) ";
      $params['search'] = strtolower($search);
    }

    // when disable order, it doesn't work. Check on internet.
    $query2 .= "ORDER BY ${order_column} ${order_direction} ";
    $query2 .= "LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query2, $params2);
  }




  public function get_letter_with_persons_id($id){

    return $this->query_unique("SELECT letter.id, letter.title, letter.body, letter.photograph, letter.created_at, letter.send_at
               FROM letter
               JOIN communication ON letter.id = communication.letter_id
               WHERE communication.letter_id = :id", ["id" => $id]);
  }






}

?>
