<?php

Flight::route('GET /letter', function(){
  $person_to_sent_id = Flight::query('person_to_sent_id');
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');
  Flight::json(Flight::letterService()->get_letter($person_to_sent_id, $offset, $limit, $search));
});

Flight::route('POST /letter', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::letterService()->add($data));
});



?>
