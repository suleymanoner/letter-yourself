<?php

/**
 * @OA\Post( path="/persons/register", tags={"persons"},
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
Flight::route('POST /persons/register', function(){
  $data = Flight::request()->data->getData();
  Flight::personService()->register($data);
  Flight::json(["message" => "Confirmation mail has been sent. Please check your email."]);
});


Flight::route('GET /persons/confirm/@token', function($token){
  Flight::personService()->confirm($token);
  Flight::json(["message" => "Account has been activated."]);
});


/**
 * @OA\Post( path="/persons/login", tags={"persons"},
 *    @OA\RequestBody(description="Person info", required=true,
 *        @OA\MediaType(
 *            mediaType="application/json",
 *            @OA\Schema(
 *                @OA\Property(property="email", required="true", type="string", example="suleyman_oner@galp.com", description="Email of person"),
 *                @OA\Property(property="password", required="true", type="string", example="12345", description="Password")
 *            )
 *        )
 * ),
 *    @OA\Response(response="200", description="Person has been created.")
 * )
 */
Flight::route('POST /persons/login', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::personService()->login($data));
});










?>
