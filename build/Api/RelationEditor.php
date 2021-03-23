<?php

///////////////////////////////////////////////////////////////////////////
////////////////////ver0.1/////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

function RelationEditor($get,$user_id)
{ include_once $_SERVER['DOCUMENT_ROOT'].'/Api/config/apiconfig.php';
   
    
  if(array_key_exists ('v',$get)){ $ver =  $get['v'];}else{$ver =$actualApiVersion;}
 include ($_SERVER['DOCUMENT_ROOT'].'/Api/relation/RelationEditor'.$ver.'.php');
    $arrayfuncandmeth = explode(".", $get['method']);
    $func = $arrayfuncandmeth[1];
 
    switch ($func)
    {
    ///////////////////////////////////////////////////////
     case "new_request"://отправить запрос
        $nw = new Relation($user_id);
        $zapros = $nw->new_friend_request($get['id']);
        if($zapros!="error")
        {
            echo json_encode(array(
                "answer"=>"500",
                "message" => "новостная лента успешно получена",
                "res"=>$zapros
            ), JSON_UNESCAPED_UNICODE);
        }
        else{ echo json_encode(array(
            "answer"=>"501",
            "message" => "новостная лента не удалось получить",
            "res"=>$zapros
        ), JSON_UNESCAPED_UNICODE);}
        break;
    ///////////////////////////////////////////////////////
    case "delete_request"://отменить запрос
        $nw = new Relation($user_id);
        $zapros = $nw->delete_friend_request($get['id']);
        if($zapros!="error")
        {
            echo json_encode(array(
                "answer"=>"514",
                "message" => "новостная лента успешно получена",
                "res"=>$zapros
            ), JSON_UNESCAPED_UNICODE);
        }
        else{ echo json_encode(array(
            "answer"=>"515",
            "message" => "новостная лента не удалось получить",
            "res"=>$zapros
        ), JSON_UNESCAPED_UNICODE);}
        break;
    //////////////////////////////////////////////////////
      case "AcceptRequest"://принять запрос в друзья
        $nw = new Relation($user_id);
        $zapros = $nw->delete_friend_request($get['id']);
        if($zapros!="error")
        {
            echo json_encode(array(
                "answer"=>"502",
                "message" => "новостная лента успешно получена",
                "res"=>$zapros
            ), JSON_UNESCAPED_UNICODE);
        }
        else{ echo json_encode(array(
            "answer"=>"503",
            "message" => "новостная лента не удалось получить",
            "res"=>$zapros
        ), JSON_UNESCAPED_UNICODE);}
        break;
    ////////////////////////////////////////////////////// 
      case "rejectRequest"://отклонить запрос в друзья
        $nw = new Relation($user_id);
        $zapros = $nw->delete_friend_request($get['id']);
        if($zapros!="error")
        {
            echo json_encode(array(
                "answer"=>"504",
                "message" => "новостная лента успешно получена",
                "res"=>$zapros
            ), JSON_UNESCAPED_UNICODE);
        }
        else{ echo json_encode(array(
            "answer"=>"505",
            "message" => "новостная лента не удалось получить",
            "res"=>$zapros
        ), JSON_UNESCAPED_UNICODE);}
         break;
    ///////////////////////////////////////////////////////
      case "subscribe"://подписаться
        $nw = new Relation($user_id);
        $zapros = $nw->subscribe($get['id']);
        if($zapros!="error")
        {
            echo json_encode(array(
                "answer"=>"506",
                "message" => "новостная лента успешно получена",
                "res"=>$zapros
            ), JSON_UNESCAPED_UNICODE);
        }
        else{ echo json_encode(array(
            "answer"=>"507",
            "message" => "новостная лента не удалось получить",
            "res"=>$zapros
        ), JSON_UNESCAPED_UNICODE);}
        break;
    ///////////////////////////////////////////////////////
      case "unsubscribe"://отменить подписку
        $nw = new Relation($user_id);
        $zapros = $nw->unsubscribe($get['id']);
        if($zapros!="error")
        {
            echo json_encode(array(
                "answer"=>"516",
                "message" => "новостная лента успешно получена",
                "res"=>$zapros
            ), JSON_UNESCAPED_UNICODE);
        }
        else{ echo json_encode(array(
            "answer"=>"517 ",
            "message" => "новостная лента не удалось получить",
            "res"=>$zapros
        ), JSON_UNESCAPED_UNICODE);}
        break;
   
    }
}
?>