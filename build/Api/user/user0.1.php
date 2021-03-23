<?php
class User{
public $id;
public $name;
public $lastname;
public $profile_img;


function GetUserByID($user_id)
{
    $db =new DataBase();
     $conn = $db->connectDB();
 
   $req ="SELECT *
    
    FROM `user`
    WHERE user_id =".'"'.$user_id.'"';
   
    try{
        $statement = $conn->query($req);
        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
          $this->id = $row["user_id"];
          $this->name = $row["name"];
          $this->lastname = $row["lastname"]; 
          $this->date_Birthday = $row["Date_Birthday"];
           
        }
       return $this;
    } catch(PDOException $exception) 
    {

    }
}

}
?>