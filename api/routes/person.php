<?php

Flight::route('POST /persons/register', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::personService()->register($data));
});


Flight::route('GET /persons/confirm/@token', function($token){
  Flight::personService()->confirm($token);
  Flight::json(["message" => "Account has been activated."]);
});

Flight::route('GET /persons/@id', function($id){
  $person = Flight::personService()->get_by_id($id);
  Flight::json($person);
});








?>
