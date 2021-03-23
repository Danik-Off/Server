<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////OpenApi.php V:0.1/////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Origin: http://localhost/');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
/////////////////////////////////////////////////////////////////
include_once 'Api/config/DB.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Api/auth.php';

require 'Api/NewsEditor.php';

/////////////////////////////////////////////////////////////////
$method =$_GET["method"];
$token = $_GET["token"];
//////////////////////////////////////////////////////////////////
if($method =="registr"){
$reg = new Auth();
$name =$_GET["name"];
$lastname =$_GET["lastname"];
$login =$_GET["login"];
$password =$_GET["password"];
echo "ok";
if(($name!=null)and($lastname!=null)and($login!=null)and($password!=null))
{$answer = $reg->create_new_accaunt($name,$lastname,$login,$password);
    if($answer==901){
        echo json_encode(array(
            "answer"=>"901",
            "message" => "акаунт с таким логином уже существует"
           
        ), JSON_UNESCAPED_UNICODE);}
    if($answer==900){
        echo json_encode(array(
            "answer"=>"900",
            "message" => "акаунт создан успешно",        
        ), JSON_UNESCAPED_UNICODE);
    }
}
else{
    echo json_encode(array(
        "answer"=>"902",
        "message" => "для регистрации необходимо как минимум 4 пункта name,lastname,login,password",
    ), JSON_UNESCAPED_UNICODE);
}
exit;
}
//////////////////////////////////////////////////////////////////
if($method =="login")
{   $reg = new Auth();
    $login =$_GET["login"];
    $password =$_GET["password"];
    if(($login!=null)and($password!=null))
{$answer = $reg->Login($login,$password);
   
    if($answer!="error"){
        echo json_encode(array(
            "answer"=>"800",
            "message" => "авторизация успешна", 
            "token"=>$answer       
        ), JSON_UNESCAPED_UNICODE);
    }
    else{
        echo json_encode(array(
            "answer"=>"801",
            "message" => "авторизация не удалась",        
        ), JSON_UNESCAPED_UNICODE);
    }
}else{
    echo "no";
}
exit;
}
////////////////////////////////////////////////////////////

if($token!=null)
{
    $reg = new Auth();
  
$user = $reg->checkToken($token);
if($user->id!=null)
{  $arrayfuncandmeth = explode(".", $method);
    $meth = $arrayfuncandmeth[0];
    $get =[];
    $query  = explode('&', $_SERVER['QUERY_STRING']);
   
    foreach($query as $param)
    {
        list($name, $value) = explode('=', $param, 2);
       if( !array_key_exists ($name,$get))
       {
        $get+=[$name=>$value];
       }
       else
       {if(is_array($get[$name]))
        {
        array_push($get[$name],$value);
        }
        else
        {
            $get[$name] = array($get[$name],$name);
        }
       
       }
     
    }
     switch($meth)
   {
    case"news":
       
 NewsEditor($get,$user->id);
    break;
    case"user":
UserEditor($get,$user->id);
    break;
    case"relation":
    RelationEditor($get,$user->id);
    break;
    default:
    echo "d";
    break;
   }
}else
{
    echo json_encode(array(
        "answer"=>"701",
        "message" => "Токен не актуален",        
    ), JSON_UNESCAPED_UNICODE);
}
}
else
{
    echo json_encode(array(
        "answer"=>"603",
        "message" => "токен равен null",        
    ), JSON_UNESCAPED_UNICODE);
}

?>