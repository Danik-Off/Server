<?php


include_once 'Api/libs/php-jwt-master/src/BeforeValidException.php';
include_once 'Api/libs/php-jwt-master/src/ExpiredException.php';
include_once 'Api/libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'Api/libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

 function createJWT($hash,$user_id,$ip)//создание JWT  необходима библиотека php-JWT 
{ include_once 'Api/config/core.php';
    $token = array(
        "iss" => $iss,
        "aud" => $aud,
        "iat" => $iat,
        "nbf" => $nbf,
        "data" => array(
            "id" => $user_id,
            "ip" =>$ip,
            "app" => 000001,
        )
     );
     return JWT::encode($token, $hash);
}
function getIp() {
    $value = '';
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$value = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$value = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} elseif (!empty($_SERVER['REMOTE_ADDR'])) {
		$value = $_SERVER['REMOTE_ADDR'];
	}
  
	return $value;
}


?>