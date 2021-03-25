<?php

Flight::route('POST /letter', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::letterService()->add($data));
});



?>
