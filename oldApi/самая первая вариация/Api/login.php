<?php

// заголовки 

error_reporting(-1);





header("Content-Type: application/json; charset=UTF-8");



header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 

// здесь будет соединение с БД

// файлы необходимые для соединения с БД 

include_once 'config/database.php';

include_once 'objects/user.php';

include_once 'config/appinfo.php';

include_once 'FuncForApi/core.php';

 $ip = getIp();

// получаем соединение с базой данных 

$database = new Database();

$db = $database->getConnection();

 

// создание объекта 'User' 

$user = new User($db);

 

// получаем данные 



 

// устанавливаем значения 

$login=$_GET["login"];
$password =$_GET["password"];
$user->email = $login;

$email_exists = $user->emailExists();

 

 
// файлы для JWT будут здесь





 

// существует ли электронная почта и соответствует ли пароль тому, что находится в базе данных 

include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
 
// существует ли электронная почта и соответствует ли пароль тому, что находится в базе данных 
if ( $email_exists and password_verify (  $password , $user->password)  ) {
 
    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
           "id" => $user->id,
           "firstname" => $user->firstname,
           "lastname" => $user->lastname,
           "email" => $user->email
       )
    );

    

  

    http_response_code(200);

 

    

    

 
    $jwt = JWT::encode($token, $key);
    echo json_encode(

        array( 

            "message" => "вход выполнен успешно",

          

            "token"=>$jwt
            

        )

        , JSON_UNESCAPED_UNICODE

    );

 

}

 

// Если электронная почта не существует или пароль не совпадает, 

// сообщим пользователю, что он не может войти в систему 

else {

 

  // код ответа 

  http_response_code(401);



  // сказать пользователю что войти не удалось 
  
  echo  json_encode(array("message" => "не удалось войти","ads"=>$ttt), JSON_UNESCAPED_UNICODE);

}

function getIp() {

  $keys = [

    'HTTP_CLIENT_IP',

    'HTTP_X_FORWARDED_FOR',

    'REMOTE_ADDR'

  ];

  foreach ($keys as $key) {

    if (!empty($_SERVER[$key])) {

      $ip = trim(end(explode(',', $_SERVER[$key])));

      if (filter_var($ip, FILTER_VALIDATE_IP)) {

        return $ip;

      }

    }

  }

}

?>