<?php

include_once 'includes/config.php';
include_once 'classes/JWT.php';

// on crée le header
$header = [
  'type' => 'JWT',
  'alg' => 'HS256'
];
//on crée le contenu
$payload = [
  'user_id' => 123,
  'roles' => [
    'ROLE_ADMIN',
    'ROLE_USER'
  ]
];

$jwt = new JWT();

$token = $jwt->generate($header, $payload, SECRET, 15400);

echo $token;
 ?>
