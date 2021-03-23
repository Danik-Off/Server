<?php
include_once 'Api/config/DB.php';
include_once 'Api/auth.php';
include_once 'Api/msgbycode.php';

     $reg = new Auth();
     echo json_encode( $reg->checkToken($_GET['token']));
?>