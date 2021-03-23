<?php
  
class News
{
 

    function newPost($user_id,$text=null,$img=null)
    {
        
        echo "okk";
$req = "INSERT INTO `posts`
(
    `who_published_id`
)".'
    VALUES
(
   "'.$user_id.'"
);';
if ($text!=null)
{
$req =$req."INSERT INTO `posts.text`(`post_id`, `text`) VALUES (LAST_INSERT_ID(),'$text');";
}
if($img!=null){
    if(!is_array($img))
    {
    $img_n = array($img);
    }
    else{$img_n = $img;}
    
    
        foreach($img_n as $img_one)
        {
            
           $req = $req."INSERT INTO `posts.img`(`post_id`, `img_url`) VALUES (LAST_INSERT_ID(),'$img_one');";
         echo"os";
        }
        echo $req;
       
}

try{
    $db =new DataBase();
   $this->conn = $db->connectDB();
    $affectedRows = $this->conn->exec($req);
    return $affectedRows;
} catch(PDOException $exception) {
return $exception;

}
    }
    
function GetPosts()
{
 $req = " SELECT
  posts.post_id, 
  posts.who_published_id,
  posts.publication_date,
  `posts.text`.text,
  `posts.img`.`img_url`,
  user.name,user.lastname,
  user.prof_img_url
  FROM `posts`
  LEFT JOIN user on user.user_id = posts.who_published_id
  LEFT JOIN `posts.img` on `posts.img`.`post_id` = posts.post_id 
  LEFT JOIN `posts.text` on `posts.text`.`post_id` = posts.post_id";

$posts = array();
$postObj = (object) [
    'post_id' => '',
    'date_time'=>'',
    'published' =>'',
    'content'=>''
  ];
 $post_published= (object)['user_id'=>"","user_name" =>"","user_lastname"=>"","user_prof_img_url"=>""];
 $post_content = (object)['text'=>"",'imgs'=>""];
 $post_imgs = array();
  $db =new DataBase();
   $conn = $db->connectDB();
try{
    $statement = $conn->query($req);
   $count =0;
   $oldpost_id="";

    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        if ($oldpost_id != $row['post_id']){
            $post_imgs =[];
        $postObj = (object) [
            'post_id' => '',
            'date_time'=>'',
            'published' =>'',
            'content'=>''
          ];
     $post_published= (object)['user_id'=>"","user_name" =>"","user_lastname"=>"","user_prof_img_url"=>""];
     $post_content = (object)['text'=>""];
     $postObj->post_id= $row['post_id'];
     $oldpost_id=$row['post_id'];
     $postObj->date_time = $row['publication_date'];
     $post_published->user_name =$row['name']; 
     $post_published->user_lastname =$row['lastname'];
     $post_published->user_id =$row['who_published_id'];
     $post_published->user_prof_img_url =$row['prof_img_url'];
     $post_content->text =$row['text'];
     array_push( $post_imgs,$row['img_url']);
     $post_content->imgs = $post_imgs;
     $postObj->published=$post_published;
     $postObj->content =$post_content;
     array_push($posts,$postObj);}
     else
     {
        array_push(  $postObj->content->imgs,$row['img_url']);
     }
    
    

    }
    return $posts;
   
   
} catch(PDOException $exception) {
return "error";
exit;
}
}
function GetPostsByid($id)
{
    $req = " SELECT posts.`post_id`, posts.`who_published_id`, posts.`text`, posts.`publication_date`,user.name,user.lastname,user.prof_img_url  FROM
    posts, user
WHERE 
user.user_id = posts.who_published_id and posts.who_published_id = ".$id;
$posts = array();
$postObj = (object) [
    'post_id' => '',
    'date_time'=>'',
    'published' =>'',
    'content'=>''
  ];
 $post_published= (object)['user_id'=>"","user_name" =>"","user_lastname"=>"","user_prof_img_url"=>""];
 $post_content = (object)['text'=>"","imgs" =>""];
  $db =new DataBase();
   $conn = $db->connectDB();
try{
    $statement = $conn->query($req);
  
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $postObj = (object) [
            'post_id' => '',
            'date_time'=>'',
            'published' =>'',
            'content'=>''
          ];$post_published= (object)['user_id'=>"","user_name" =>"","user_lastname"=>"","user_prof_img_url"=>""];
          $post_content = (object)['text'=>"","imgs" =>""];
     $postObj->post_id= $row['post_id'];
     $postObj->date_time = $row['publication_date'];
     $post_published->user_name =$row['name']; 
     $post_published->user_lastname =$row['lastname'];
     $post_published->user_id =$row['who_published_id'];
     $post_published->user_prof_img_url =$row['prof_img_url'];
     $post_content->text =$row['text'];
     $post_content->imgs =$row['imgs'];
     $postObj->published=$post_published;
     $postObj->content =$post_content;
     array_push($posts,$postObj);

    }
    return $posts;
   
   
} catch(PDOException $exception) {
return "error";
exit;
}
}

}
?>