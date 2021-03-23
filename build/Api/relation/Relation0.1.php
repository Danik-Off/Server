<?php
class Relation
{//$uid id пользователя с кем делать манипуляции $user_id - пользователь от чьего лица совершаем действия
    private $user_id;
    function __construct($suser_id)
    {
        
        $this->user_id=$suser_id;
    }
 function new_friend_request($uid)//отправить заявку в друзья
 {
    $req = "INSERT INTO `relations`
    (
        `first_user`, `two_user`, `relationship_type`
    )".'
        VALUES
    (
       "'.$this->user_id.'","'.$uid.'","friend_request"
    )';
    try{
        $db =new DataBase();
       $this->conn = $db->connectDB();
        $affectedRows = $this->conn->exec($req);
        return $affectedRows;
    } catch(PDOException $exception) {
        return "error";
    }
 }
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////
 function delete_friend_request($uid)//отправить заявку в друзья
 {
    $req = "DELETE FROM `relations` WHERE relationship_type=".'"friend_request" and first_user = "'.$this->user_id.'"  and two_user ="'.$uid.'"';
      
    try{
        $db =new DataBase();
       $this->conn = $db->connectDB();
        $affectedRows = $this->conn->exec($req);
        return $affectedRows;
    } catch(PDOException $exception) {
    return "error";
    }
 }
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////
 function accept_friend_request($uid)//принять заявку в друзья 
 {
  //  $req = "UPDATE `relations` SET `relationship_type`=".'"friend" WHERE first_user = "'.$uid.'" AND two_user = "'.$this->user_id.'"' ;
    $req = "UPDATE `relations` SET `relationship_type`=".'"friend" WHERE first_user = "'.$this->user_id.'" AND two_user = "'.$uid.'"' ;
    try{
        $db =new DataBase();
       $this->conn = $db->connectDB();
        $affectedRows = $this->conn->exec($req);
        return $affectedRows;
    } catch(PDOException $exception) {
        return "error";
    }
 }
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function reject_friend_request($uid)//отклонить заявку в друзья 
 {
    $req = "UPDATE `relations` SET `relationship_type`=".'"subscription" WHERE first_user = "'.$uid.'" AND two_user = "'.$this->user_id.'"' ;
    try{
        $db =new DataBase();
       $this->conn = $db->connectDB();
        $affectedRows = $this->conn->exec($req);
        return $affectedRows;
    } catch(PDOException $exception) {
        return "error";
    }
 }
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function subscribe($uid)// подписаться 
 {
    $req = "INSERT INTO `relations`
    (
        `first_user`, `two_user`, `relationship_type`
    )".'
    
        VALUES
    (
       "'.$this->user_id.'","'.$uid.'","friend_request"
    )';
    try{
        $db =new DataBase();
       $this->conn = $db->connectDB();
        $affectedRows = $this->conn->exec($req);
        return $affectedRows;
    } catch(PDOException $exception) {
        return "error";
    }
 }
 function unsubscribe($uid)// подписаться 
 {
    
 }

}//
?>