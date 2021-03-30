<?php

Flight::route('GET /letter', function(){
  $person_to_sent_id = Flight::query('person_to_sent_id');
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');
  Flight::json(Flight::letterService()->get_letter($person_to_sent_id, $offset, $limit, $search, $order));
});

// not works, it return false on postman. check here
Flight::route('GET /letter/@id', function($id){
  Flight::json(Flight::letterService()->get_by_id($id));
});

// not works, it return false on postman. check here
Flight::route('POST /letter', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::letterService()->add($data));
});

Flight::route('PUT /letter/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::letterService()->update($id, $data));
});


?>
