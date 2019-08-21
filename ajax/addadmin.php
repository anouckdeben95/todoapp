<?php
require_once("../bootstrap.php");
Session::check();

if( !empty($_POST)) {

    //get the userid
    $id = $_POST['user'];
    
    try {
        $user = new Admin;
        $u = $user->makeAdmin($id);
    
        //succes
        $result = [
            "status" => "success",
            "message" => "admin was added"
        ];
    }
    
    catch( Throwable $t ){
        
        //error
         $result = [
            "status" => "error",
            "message" => "admin wasn't added"
         ];
    }
    
    echo json_encode($result);
}