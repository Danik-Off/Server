<?php
include_once './Api/libs/minilib/Mini_Lib.php';
include_once './Api/config/DB.php';

//include_once './Api/user.php';

class Auth{
 private   $conn;
 private $user_id;
function __construct()
{
   
}
//////////////////////////////////////////////////
function Login($login,$password)
{ 
   if(!$this->checkPassword($login,$password)){//если пароли не совпадают то говорим об этом и завершаем выполнение кода
return "error";

   }
 
   try
   {
       $hash =bin2hex(random_bytes(20));
       $ip =getIp();
    $token =   createJWT($hash,$this->user_id,$ip);
    $this->InsertSecure($hash,$ip,$token);
   return $token;
   }
   catch(PDOException $exception) { return "error";}
   
}
/////////////////////////////////////////////////////////////////////////////
function create_new_accaunt($name,$lastname,$login,$password){
if(!$this->checkLogin($login)){
  $pass = password_hash($password, PASSWORD_DEFAULT);
$req = "INSERT INTO `user`
(
    `name`, `lastname`, `login`, `password`
)".'
    VALUES
(
   "'.$name.'","'.$lastname.'","'.$login.'","'.$pass.'"
)';

try{
    $db =new DataBase();
   $this->conn = $db->connectDB();
    $affectedRows = $this->conn->exec($req);
    return 900;
} catch(PDOException $exception) {
return $exception;

}

}else
{
return 901;
exit;
}
}
//////////////////////////////////////////////////////////////////////////////
private function checkLogin($_login){//проеверяет существует ли акаунт с таким логином
    $db =new DataBase();
    $this->conn = $db->connectDB();
 
   $req ="SELECT `user_id`
    
    FROM `user`
    WHERE login =".'"'.$_login.'"';
   
    $counts=0;
    try{
        $statement = $this->conn->query($req);
        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
           
            $counts++;
        }
        if($counts>0){
            return true;
        }
        else{
            return false;
        }
       
    } catch(PDOException $exception) {
   echo $exception;
   exit;
    }

}
private function checkPassword($_login,$password)//сверяет пароль в базе данных и тот что дает пользователь
{
    $db =new DataBase();
    $this->conn = $db->connectDB();
    $req ="SELECT `user_id`, `name`, `lastname`,  `login`, `password`
    
    FROM `user`
    WHERE login =".'"'.$_login.'"';
  
   $_pass="";
    
    try{
        $statement = $this->conn->query($req);
       
        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
           $_pass  = $row['password'];
           $this->user_id=$row['user_id'];

        }
        if(password_verify($password,$_pass)){
            return true;
        }
        else{
            return false;
        }
       
    } catch(PDOException $exception) {
   echo $exception;
   exit;
    }
}
private function InsertSecure($hash,$ip,$token)//записывает вход в бд
{
    $req = "INSERT INTO `secure`(`user_id`, `ip`, `hash`,`Token`)
        VALUES".'
    (
       "'.$this->user_id.'","'.$ip.'","'.$hash.'","'.$token.'"
    )';
   
    try{
        $db =new DataBase();
       $this->conn = $db->connectDB();
        $affectedRows = $this->conn->exec($req);
        return 900;
    } catch(PDOException $exception) {
   echo $exception;
    
    }
}
function checkToken($token)//проверяет токен и если он есть  то возращает данные пользователя
{
    
  $req ='SELECT  * FROM user RIGHT JOIN secure USING(user_id) WHERE Token="'.$token.'"';
 
    try{
        $db =new DataBase();
       $this->conn = $db->connectDB();
     //   $affectedRows = $this->conn->exec($req);
     $statement = $this->conn->query($req);
       $usver =   $postObj = (object) [
        'name' => '',
        'lastname'=>'',
        'id' =>'',
      ]; 
     while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
       $usver->name = $row['name'];
       $usver->lastname = $row['lastname'];
    
       $usver->id= $row['user_id'];
     }
     return $usver;
    } catch(PDOException $exception) {
    return $exception;
    
    }
}



}



?>