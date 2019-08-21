<?php
require_once("../bootstrap.php");
Session::check();

if( !empty($_POST)) {

    //get the rowid
    $rowid = $_POST['taskid'];
    
    try {
        $image = new Image;
        $i = $image->delete($rowid);
    
        //succes
        $result = [
            "status" => "success",
            "message" => "image is removed"
        ];
    }
    
    catch( Throwable $t ){
        
        //error
         $result = [
            "status" => "error",
            "message" => "image wasn't removed"
         ];
    }
    
    echo json_encode($result);
}