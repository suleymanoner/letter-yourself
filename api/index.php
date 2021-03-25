<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/routes/accounts.php';
require_once dirname(__FILE__).'/routes/person.php';
require_once dirname(__FILE__).'/routes/letter.php';
require_once dirname(__FILE__).'/services/AccountService.class.php';
require_once dirname(__FILE__).'/services/PersonService.class.php';
require_once dirname(__FILE__).'/services/LetterService.class.php';

Flight::set('flight.log_errors', TRUE);

/* Error handling for API */
Flight::map('error', function(Exception $ex){
  // it is handles error and changes html format to application/json format.
  Flight::json(["message" => $ex->getMessage()], $ex->getCode());
});

// This method parse query parameters.
Flight::map('query', function($name, $default_value = NULL){
  $request = Flight::request();
  $query_param = @$request->query->getData()[$name];
  $query_param = $query_param ? $query_param : $default_value;
  return $query_param;
});

Flight::register('accountService','AccountService');
Flight::register('personService','PersonService');
Flight::register('letterService','LetterService');

Flight::start();

?>
