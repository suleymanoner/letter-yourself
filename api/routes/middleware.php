<?php

Flight::before('start', function(&$params, &$output){

  if(Flight::request()->url == '/swagger') return TRUE;

  if(str_starts_with(Flight::request()->url, '/persons/')) return TRUE;


  $headers = getallheaders();
  $token = @$headers['Authentication'];
  try {
    $decoded = (array)\Firebase\JWT\JWT::decode($token, "JWT SECRET", ['HS256']);
    Flight::set('person', $decoded);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }


});



?>
