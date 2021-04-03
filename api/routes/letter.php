<?php
/**
 * @OA\Get(path="/person/letter", tags={"x-person", "letter"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for account. Case insensetive."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting : '-column_name' ascending order, '+column_name' descending order"),
 *     @OA\Response(response="200", description="List letters")
 * )
 */
Flight::route('GET /person/letter', function(){
  //not works, there is problem with setting person, check
  //$account_id = Flight::get('person')['aid'];

  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');
  Flight::json(Flight::letterService()->get_letter5($offset, $limit, $search, $order));
});

/**
 * @OA\Get(path="/person/letter/{id}", tags={"x-person", "letter"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of letter"),
 *     @OA\Response(response="200", description="Fetch individual letter")
 * )
 */
Flight::route('GET /person/letter/@id', function($persons_id){
  //Flight::json(Flight::communicationService()->get_letter_with_persons_id($persons_id));
  Flight::json(Flight::letterService()->get_by_id($persons_id));
});

/**
 * @OA\Post(path="/person/letter", tags={"x-person", "letter"}, security={{"ApiKeyAuth": {}}},
 *   @OA\RequestBody(description="Basic letter info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="title", required="true", type="string", example="My Letter",	description="Title of the letter" ),
 *    				 @OA\Property(property="body", required="true", type="string", example="My Dear friend..",	description="Body of the letter" ),
 *             @OA\Property(property="send_at", required="true", type="DATE_FORMAT", example="2021-03-31 22:15:00",	description="Send date of your letter" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Saved letter info.")
 * )
 */
Flight::route('POST /person/letter', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::letterService()->add($data));
});


/**
 * @OA\Put(path="/person/letter/{id}", tags={"x-person", "letter"}, security={{"ApiKeyAuth": {}}},
 *   @OA\Parameter(type="integer", in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic letter info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="title", required="true", type="string", example="My Letter",	description="Title of the letter" ),
 *    				 @OA\Property(property="body", required="true", type="string", example="My Dear friend..",	description="Body of the letter" ),
 *             @OA\Property(property="send_at", required="true", type="DATE_FORMAT", example="2021-03-31 22:15:00",	description="Send date of your letter" )
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update letter")
 * )
 */
Flight::route('PUT /person/letter/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::letterService()->update($id, $data));
});



/**
 * @OA\Get(path="/admin/letter", tags={"x-admin", "letter"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=25, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for account. Case insensetive."),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting : '-column_name' ascending order, '+column_name' descending order"),
 *     @OA\Response(response="200", description="List letters")
 * )
 */
Flight::route('GET /admin/letter', function(){
//$account_id = Flight::get('person')['aid'];
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');
  $order = Flight::query('order', '-id');
  Flight::json(Flight::letterService()->get_letter5($offset, $limit, $search, $order));
});

/**
 * @OA\Get(path="/admin/letter/{id}", tags={"x-admin", "letter"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="Id of letter"),
 *     @OA\Response(response="200", description="Fetch individual letter.")
 * )
 */
Flight::route('GET /admin/letter/@id', function($id){
  Flight::json(Flight::letterService()->get_by_id($id));
});

/**
 * @OA\Post(path="/admin/letter", tags={"x-admin", "letter"}, security={{"ApiKeyAuth": {}}},
 *   @OA\RequestBody(description="Basic letter info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="title", required="true", type="string", example="My Letter",	description="Title of the letter" ),
 *    				 @OA\Property(property="body", required="true", type="string", example="My Dear friend..",	description="Body of the letter" ),
 *             @OA\Property(property="send_at", required="true", type="DATE_FORMAT", example="2021-03-31 22:15:00",	description="Send date of your letter" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Saved letter info.")
 * )
 */
Flight::route('POST /admin/letter', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::letterService()->add($data));
});


/**
 * @OA\Put(path="/admin/letter/{id}", tags={"x-admin", "letter"}, security={{"ApiKeyAuth": {}}},
 *   @OA\Parameter(type="integer", in="path", name="id", default=1),
 *   @OA\RequestBody(description="Basic letter info that is going to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="title", required="true", type="string", example="My Letter",	description="Title of the letter" ),
 *    				 @OA\Property(property="body", required="true", type="string", example="My Dear friend..",	description="Body of the letter" ),
 *             @OA\Property(property="send_at", required="true", type="DATE_FORMAT", example="2021-03-31 22:15:00",	description="Send date of your letter" )
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Updated letter")
 * )
 */
Flight::route('PUT /admin/letter/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::letterService()->update($id, $data));
});


?>
