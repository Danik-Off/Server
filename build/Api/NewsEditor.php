<?php

///////////////////////////////////////////////////////////////////////////
////////////////////ver0.1/////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

function NewsEditor($get,$user_id)
{ include_once $_SERVER['DOCUMENT_ROOT'].'/Api/config/apiconfig.php';
   
    
  if(array_key_exists ('v',$get)){ $ver =  $get['v'];}else{$ver =$actualApiVersion;}
 include ($_SERVER['DOCUMENT_ROOT'].'/Api/news/News'.$ver.'.php');
    $arrayfuncandmeth = explode(".", $get['method']);
    $func = $arrayfuncandmeth[1];
 
    switch ($func)
    {
      case "createPost":
        $nw = new News();
        $zapros = $nw->newPost($user_id,$get['text'],$get['img']);
        if($zapros!="error")
        {
            echo json_encode(array(
                "answer"=>"602",
                "message" => "новостная лента успешно получена",
                "res"=>$zapros
            ), JSON_UNESCAPED_UNICODE);
        }
        else{ echo json_encode(array(
            "answer"=>"603",
            "message" => "новостная лента не удалось получить",
            "res"=>$zapros
        ), JSON_UNESCAPED_UNICODE);}
        break;
    ////////////////////////////////////////////////////// 
      case "getNews":
            $nw = new News();
            $zapros = $nw->GetPosts();
        if($zapros!="error")
        {
            echo json_encode(array(
                "answer"=>"602",
                "message" => "новостная лента успешно получена",
                "res"=>$zapros
            ), JSON_UNESCAPED_UNICODE);
        }
        else{ echo json_encode(array(
            "answer"=>"603",
            "message" => "новостная лента не удалось получить",
            "res"=>$zapros
        ), JSON_UNESCAPED_UNICODE);}
         break;
    ///////////////////////////////////////////////////////

    }
}
?>