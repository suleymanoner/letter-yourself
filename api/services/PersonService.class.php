<?php

require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/PersonDao.class.php';
require_once dirname(__FILE__).'/../dao/AccountDao.class.php';

class PersonService extends BaseService{

  private $accountDao;

  public function __construct(){
    $this->dao = new PersonDao();
    $this->accountDao = new AccountDao();
  }

  public function register($person){
    if(!isset($person['account'])) throw new Exception("Account is required!");


    try{

    $account = $this->accountDao->add([
      "name" => $person['account'],
      "status" => "PENDING",
      "registered_at" => date(Config::DATE_FORMAT)
    ]);

    $person = parent::add([
      "account_id" => $account['id'],
      "name" => $person['name'],
      "surname" => $person['surname'],
      "email" => $person['email'],
      "password" => $person['password'],
      "status" => "PENDING",
      "created_at" => date(Config::DATE_FORMAT),
      "token" => md5(random_bytes(16))
     ]);
    }
    catch(\Exception $e){
      throw $e;
    }

    //here we need send email with token

    return $person;

  }

  public function confirm($token){
    $person = $this->dao->get_person_by_token($token);

    if(!isset($person['id'])) throw new Exception("Invalid token");

    $this->dao->update($person['id'], ["status" => "ACTIVE"]);
    $this->accountDao->update($person['account_id'], ["status" => "ACTIVE"]);


  }



}



?>
