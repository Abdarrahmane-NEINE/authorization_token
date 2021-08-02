<?php
header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST')
{

  // On vérifie si on reçoit un token
  if(isset($_SERVER['Authorization'])){
    $token = trim($_SERVER['Authorization']);
  }elseif(isset($_SERVER['HTTP_AUTHORIZATION'])){
    $token = trim($_SERVER['HTTP_AUTHORIZATION']);
  }elseif(function_exists('apache_request_headers')){
    $requestHeaders = apache_request_headers();
    if(isset($requestHeaders['Authorization'])){
      $token = trim($requestHeaders['Authorization']);
    }
  }

  // on vérifie si on a un token
  if(!isset($token) || !preg_match('/Bearer\s(\S+)/', $token, $matches)){

    http_response_code(405);

    echo json_encode(['message' => 'Token introuvable']);

    exit;
  }
  // on extrait le token
  $token = str_replace('Bearer ', '' , $token);

  include_once 'includes/config.php';
  include_once 'classes/JWT.php';

  $jwt = new JWT();

  // on vérifie la signature
  if(!$jwt->check($token, SECRET)){

    http_response_code(403);

    echo json_encode(['message' => 'le Token est invalide']);

    exit;

  }

  // on varifie la vadidité
  if(!$jwt->isTokenValid($token)){

    http_response_code(400);

    echo json_encode(['message' => 'Token invalide']);

      exit;
  }

  // on verifie l'expiration
  if($jwt->isTokenExpired($token)){

    http_response_code(403);

    echo json_encode(['message' => 'le Token a expiré']);

    exit;

  }

echo json_encode(['message' => $token]);
}
else {

  http_response_code(405);

  echo json_encode(['message' => 'Methode non autorisée']);

  exit;
}

?>
