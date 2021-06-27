<?php
require_once dirname(__FILE__)."/BaseDao.class.php";
class PersonDao extends BaseDao{


  public function __construct(){
    parent::__construct("persons");
  }

  public function get_person_by_email($email){
    return $this->query_unique("SELECT * FROM persons WHERE email = :email", ["email" => $email]);
  }

  public function get_person_by_account_id($id){
    return $this->query_unique("SELECT * FROM persons WHERE account_id = :id", ["id" => $id]);
  }

  public function get_all_persons($role, $offset, $limit, $search, $order){
    list($order_column, $order_direction) = self::parse_order($order);

    $params = [];

    $query = "SELECT *
              FROM persons
              WHERE 1 = 1 ";

    $query .="AND role = '${role}' ";

    if (isset($search)){
      $query .= "AND ( LOWER(name) LIKE CONCAT('%', :search, '%') OR LOWER(surname) LIKE CONCAT('%', :search, '%')) ";
      $query .= "AND ( email LIKE CONCAT('%', :search, '%') OR status LIKE CONCAT('%', :search, '%')) ";
      $params['search'] = strtolower($search);
    }

    $query .="ORDER BY ${order_column} ${order_direction} ";
    $query .="LIMIT ${limit} OFFSET ${offset}";

    return $this->query($query, $params);
  }

  public function update_person_by_email($email, $person){
    $this->update("persons", $email, $person, "email");
  }

  public function get_person_by_token($token){
    return $this->query_unique("SELECT * FROM persons WHERE token = :token", ["token" => $token]);
  }

}
?>
