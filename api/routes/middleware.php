<?php

Flight::route('/person/*', function(){
  try {
    $person = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWT_SECRET, ["HS256"]);
    if(Flight::request()->method != "GET" && $person["r"] == "USER_READ_ONLY"){
      throw new Exception("You can't change anything.", 403);
    }
    Flight::set('person', $person);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});

Flight::route('/admin/*', function(){
  try {
    $person = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWT_SECRET, ["HS256"]);
    if ($person["r"] != "ADMIN"){
      throw new Exception("Admin access required.", 403);
    }
    Flight::set('person', $person);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});




/*
  Flight::before('start', function(&$params, &$output){
    if(Flight::request()->url == '/swagger') return TRUE;

    try {
        $person = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication") , Config::JWT_SECRET, ['HS256']);
        //print_r($person); die;
        if(Flight::request()->method != "GET" && $person['r'] == "USER_READ_ONLY"){
          throw new Exception("Read only users can't change anything.", 403);
        }
        Flight::set('person', $person);
        return TRUE;
      } catch (\Exception $e) {
        Flight::json(["messsage" => $e->getMessage()], 401);
        die;
      }
    });

*/



?>
