<?php
const TOKEN = 'eyJ0eXBlIjoiSldUIiwiYWxnIjoiSFMyNTYifQ.eyJ1c2VyX2lkIjoxMjMsInJvbGVzIjpbIlJPTEVfQURNSU4iLCJST0xFX1VTRVIiXSwiaWF0IjoxNjI3Mzc0MzE4LCJleHAiOjE2MjczODk3MTh9.F_XKPlsG2C-axLiFE0QLiic8XMjxIfKX8kMvGEQUAws';


include_once 'includes/config.php';
include_once 'classes/JWT.php';

$jwt = new JWT();

// var_dump($jwt->isTokenValid(TOKEN));

 ?>
