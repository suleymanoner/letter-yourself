<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/PersonDao.class.php";
require_once dirname(__FILE__)."/dao/AccountDao.class.php";


$dao = new PersonDao();

//$person = $person_dao->get_person_by_id(21);

//$person_dao->get_person_by_email("suleyman@gmail.com");

print_r($dao1);

?>
