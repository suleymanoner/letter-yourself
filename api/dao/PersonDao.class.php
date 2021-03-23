<?php
require_once dirname(__FILE__)."/BaseDao.class.php";
class PersonDao extends BaseDao{


  public function __construct(){
    parent::__construct("persons");
  }

  public function get_person_by_email($email){
    return $this->query_unique("SELECT * FROM persons WHERE email = :email", ["email" => $email]);
  }

  public function update_person_by_email($email, $person){
    $this->update("persons", $email, $person, "email");
  }

  public function get_person_by_token($token){
    return $this->query_unique("SELECT * FROM persons WHERE token = :token", ["token" => $token]);
  }

}
?>
