<?php

///////////////////////////////////////////////////////////////////////////
////////////////////ver0.1/////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

function UserEditor($get,$user_id)
{ include_once $_SERVER['DOCUMENT_ROOT'].'/Api/config/apiconfig.php';
   
    
  if(array_key_exists ('v',$get)){ $ver =  $get['v'];}else{$ver =$actualApiVersion;}
 include ($_SERVER['DOCUMENT_ROOT'].'/Api/user/user'.$ver.'.php');
    $arrayfuncandmeth = explode(".", $get['method']);
    $func = $arrayfuncandmeth[1];
 
    switch ($func)
    {
      case "getInfo":
       $us = new User();
       if($us->GetUserByID($_GET['id'])!='error')
       {
        echo json_encode(array(
          "answer"=>"300",
          "message" => "информация о пользователе получена успешно",
          "res"=>$zapros
      ), JSON_UNESCAPED_UNICODE);
       }
       else
       {
        echo json_encode(array(
          "answer"=>"301",
          "message" => "информация о пользователе не удалось получить",
          "res"=>$zapros
      ), JSON_UNESCAPED_UNICODE);
       }
        break;
    ////////////////////////////////////////////////////// 
    //  case "getNews":
          
       //  break;
    ///////////////////////////////////////////////////////

    }
}
?>