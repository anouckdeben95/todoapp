<?php
require_once("../bootstrap.php");
Session::check();

if( !empty($_POST)) {

    //get the userid
    $userid = $_POST['user'];
    
    try {
        $user = new Admin;
        $u = $user->removeAdmin($userid);
    
        //succes
        $result = [
            "status" => "success",
            "message" => "admin was removed"
        ];
    }
    
    catch( Throwable $t ){
        
        //error
         $result = [
            "status" => "error",
            "message" => "admin wasn't removed"
         ];
    }
    
    echo json_encode($result);
}