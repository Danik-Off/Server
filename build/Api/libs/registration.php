<?php
include_once './Api/config/DB.php';

class registr{
 private   $conn;
function __construct()
{
   
}
/////////////////////////////////////////////////////////////////////////////
function create_new_accaunt($name,$lastname,$login,$password){
if(!$this->checkLogin($login)){
$req = "INSERT INTO `user`
(
    `name`, `lastname`, `login`, `password`
)".'
    VALUES
(
   "'.$name.'","'.$lastname.'","'.$login.'","'.$password.'"
)';

try{
    $db =new DataBase();
   $this->conn = $db->connectDB();
    $affectedRows = $this->conn->exec($req);
    return $affectedRows;
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


}
?>