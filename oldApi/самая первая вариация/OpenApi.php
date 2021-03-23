<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include_once 'Api/chektoken.php';
include_once 'Api/config/appinfo.php';
include 'Api/dialogeditor.php';

//получение токена и метода
try{
$method = $_GET["method"];
$token = $_GET["token"];}
catch(Exception $e){}
if($token!=null){
    //получаем информацию о пользователе с данным токеном
    $cheks =new CheckToken();
$obj = json_decode( $cheks->check($token,$key));
if($obj->{'status'}!="true"){
    echo json_encode(array(
        "message" => "токен не активен",
        "error" => "token is null"
    ), JSON_UNESCAPED_UNICODE);
    exit;
}
$mainid = $obj->{'data'}->{'id'};


}
else{
    echo json_encode(array(
        "message" => "для использования api токен не может быть равен null",
        "error" => "token is null"
    ), JSON_UNESCAPED_UNICODE);
    exit;
}
// получаем соединение с базой данных 




switch($method){
    case "newDialog":
        $ids = $_GET["ids"];
        $deb =new DialogEditor();
      
      $keymsgs = $deb->new_Dialogfilemsgs($ids,$mainid);
      echo $keymsgs;
    
    break;

    case "newMsg":
        $key = $_GET["key"];
       $msg= $_GET["text"];
        $deb =new DialogEditor();
      
     $keymsgs = $deb->new_Msg($mainid,$key,$msg);
   echo $keymsgs;
  
    break;
    case"getDialogs":
        $deb =new DialogEditor();
        $keymsgs = $deb->Get_Dialogs($mainid);
           echo $keymsgs;
    break;
    case "getMsg":
        $key = $_GET["key"];
        $count= $_GET["count"];
        $deb =new DialogEditor();
        $keymsgs = $deb->get_Msg($mainid,$key,$count);
           echo $keymsgs;
    break;
    case "renameDialog":
        $msgskey = $_GET["key"];
  $newname=$_GET["newName"];
        $deb =new DialogEditor();
        $keymsgs = $deb->RenameDialog($msgskey,$mainid,$newname);
        echo $keymsgs;
    break;
    case "getInfoDialog":        
        $msgskey = $_GET["key"];
    $deb =new DialogEditor();  
    $keymsgs = $deb->get_DialogInfo($id,$msgskey);
    echo $keymsgs;
    break;
    case "FindUserById":
     /*   $database1 = new Database();
$dd = $database1->getConnection();
$founder = new Finder($dd);*/
    //   echo $founder->finduserbyid($id);
       echo "ok";
    break;
    default:
   
        echo json_encode(array(
            "message" => "такой метод не существует",
            "error" => "token is null"
        ), JSON_UNESCAPED_UNICODE);
       
break;

}


?>