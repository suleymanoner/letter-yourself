<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class ReceiverDao extends BaseDao{

  public function __construct(){
    parent::__construct("receiver");
  }


  public function get_receiver_email_with_id($receiver_id){
    return $this->query_unique("SELECT receiver_email FROM receiver WHERE id = :id", ["id" => $receiver_id]);
  }

  public function get_receiver_id_by_email($receiver_email){
    return $this->query_unique("SELECT id FROM receiver WHERE receiver_email = :email", ["email" => $receiver_email]);
  }


  public function update_receiver_email($receiver_email, $id){
    return $this->query_unique("UPDATE receiver SET receiver_email = :email WHERE id = :id", ["email" => $receiver_email, "id" => $id ]);
  }


}

?>
