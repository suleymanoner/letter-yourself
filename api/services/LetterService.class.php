<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/LetterDao.class.php';


class LetterService extends BaseService{

  public function __construct(){
    $this->dao = new LetterDao();
  }

  public function add_letter($account_id, $letter){
    try {
      $data = [
        "title" => $letter["title"],
        "body" => $letter["body"],
        "created_at" => date(Config::DATE_FORMAT),
        "send_at" => $letter["send_at"],
        "account_id" => $account_id
      ];
      return parent::add($data);
    } catch (\Exception $e) {
      throw $e;
    }
  }


  public function get_letter_id_by_title($title){
    return $this->dao->get_letter_id_by_title($title);
  }

  public function get_letter($account_id, $offset, $limit, $search, $order){
    return $this->dao->get_letter($account_id, $offset, $limit, $search, $order);
  }

  public function get_letter_with_account_and_letter_id($account_id, $id){
    return $this->dao->get_letter_with_account_and_letter_id($account_id, $id);
  }


  public function update_letter($person, $id, $letter){
    $db_template = $this->dao->get_by_id($id);
    //$person['aid']
    if ($db_template['account_id'] != $person){
      throw new Exception("Invalid letter", 403);
    }
    return $this->update($id, $letter);
  }


}

?>
