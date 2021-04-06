<?php

/**
 * @OA\Post( path="/register", tags={"login"},
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
  Flight::personService()->register(Flight::request()->data->getData());
  Flight::json(["message" => "Confirmation mail has been sent. Please check your email."]);
});

/**
 * @OA\Get( path="/confirm/{token}", tags={"login"},
 *     @OA\Parameter( type="string", in="path", name="token", default=12345, description="Temporary token for activate account"),
 *     @OA\Response(response="200", description="Successfull activation.")
 * )
 */
Flight::route('GET /confirm/@token', function($token){
  Flight::json(Flight::jwt(Flight::personService()->confirm($token)));
});

/**
 * @OA\Post( path="/login", tags={"login"},
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
  Flight::json(Flight::jwt(Flight::personService()->login(Flight::request()->data->getData())));
});

/**
 * @OA\Post( path="/forgot", tags={"login"}, description="Send recovery email",
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
  Flight::personService()->forgot(Flight::request()->data->getData());
  Flight::json(["message" => "Recovery token has been sent to your email."]);
});

/**
 * @OA\Post( path="/reset", tags={"login"}, description="Reset password using recovery token",
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
});


?>
