<?php

/**
 * @OA\Post( path="/register", tags={"persons"},
 *    @OA\RequestBody(description="Person info", required=true,
 *        @OA\MediaType(
 *            mediaType="application/json",
 *            @OA\Schema(
 *                @OA\Property(property="account", required="true", type="string", example="suleyman_oner", description="Name of account"),
 *                @OA\Property(property="name", required="true", type="string", example="Suleyman", description="Name of person"),
 *                @OA\Property(property="surname", required="true", type="string", example="Oner", description="Surname of person"),
 *                @OA\Property(property="email", required="true", type="string", example="suleyman_oner@galp.com", description="Email of person"),
 *                @OA\Property(property="password", required="true", type="string", example="12345", description="Password")
 *            )
 *        )
 * ),
 *    @OA\Response(response="200", description="Person has been created.")
 * )
 */
Flight::route('POST /register', function(){
  $data = Flight::request()->data->getData();
  Flight::personService()->register($data);
  Flight::json(["message" => "Confirmation mail has been sent. Please check your email."]);
});

/**
 * @OA\Get( path="/confirm/{token}", tags={"persons"},
 *     @OA\Parameter( type="string", in="path", name="token", default=12345, description="Temporary token for activate account"),
 *     @OA\Response(response="200", description="Successfull activation.")
 * )
 */
Flight::route('GET /confirm/@token', function($token){
  Flight::json(Flight::jwt(Flight::personService()->confirm($token)));
  //Flight::personService()->confirm($token);
  //Flight::json(["message" => "Account has been activated."]);
});

/**
 * @OA\Post( path="/login", tags={"persons"},
 *    @OA\RequestBody(description="Person info", required=true,
 *        @OA\MediaType(
 *            mediaType="application/json",
 *            @OA\Schema(
 *                @OA\Property(property="email", required="true", type="string", example="suleyman_oner@galp.com", description="Email of person"),
 *                @OA\Property(property="password", required="true", type="string", example="12345", description="Password")
 *            )
 *        )
 * ),
 *    @OA\Response(response="200", description="Person has been logged.")
 * )
 */
Flight::route('POST /login', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::personService()->login($data));
});

/**
 * @OA\Post( path="/forgot", tags={"persons"}, description="Send recovery email",
 *    @OA\RequestBody(description="Person info", required=true,
 *        @OA\MediaType(
 *            mediaType="application/json",
 *            @OA\Schema(
 *                @OA\Property(property="email", required="true", type="string", example="suleyman_oner@galp.com", description="Email of person")
 *            )
 *        )
 * ),
 *    @OA\Response(response="200", description="Recovery mail has been sent.")
 * )
 */
Flight::route('POST /forgot', function(){
  $data = Flight::request()->data->getData();
  Flight::personService()->forgot($data);
  Flight::json(["message" => "Recovery token has been sent to your email."]);
});

/**
 * @OA\Post( path="/reset", tags={"persons"}, description="Reset password using recovery token",
 *    @OA\RequestBody(description="Person info", required=true,
 *        @OA\MediaType(
 *            mediaType="application/json",
 *            @OA\Schema(
 *                @OA\Property(property="token", required="true", type="string", example="123", description="Recovery token"),
 *                @OA\Property(property="password", required="true", type="string", example="12345", description="New password")
 *            )
 *        )
 * ),
 *    @OA\Response(response="200", description="Person has changed password.")
 * )
 */
Flight::route('POST /reset', function(){

  Flight::json(Flight::jwt(Flight::personService()->reset(Flight::request()->data->getData())));

  //$data = Flight::request()->data->getData();
  //Flight::personService()->reset($data);
  //Flight::json(["message" => "Your password has been changed."]);
});


?>
