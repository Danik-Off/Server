<?php

///////////////////////////////////////////////////////////////////////////
////////////////////ver0.1/////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

function MsgEditor($get,$user_id)
{ include_once $_SERVER['DOCUMENT_ROOT'].'/Api/config/apiconfig.php';
   
    
  if(array_key_exists ('v',$get)){ $ver =  $get['v'];}else{$ver =$actualApiVersion;}
 include ($_SERVER['DOCUMENT_ROOT'].'/Api/news/News'.$ver.'.php');
    $arrayfuncandmeth = explode(".", $get['method']);
    $func = $arrayfuncandmeth[1];
 
    switch ($func)
    {
      case "NewMsg":
       
        break;
    ////////////////////////////////////////////////////// 
    case "DeleteMsgs":
       
      break;
  ////////////////////////////////////////////////////// 
      case "GetMsgs":
        
         break;
    ///////////////////////////////////////////////////////
    case "GetDialogs":
        
      break;
 ///////////////////////////////////////////////////////
     case "NewDialog":
        
    break;
///////////////////////////////////////////////////////
case "DeleteDialog":
       
  break;
////////////////////////////////////////////////////// 

    }
}
?>