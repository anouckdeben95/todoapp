<?php
require_once("../bootstrap.php");
Session::check();

$cbid = $_POST['cbid'];
    
    try {
        $task = new Task;
        $t = $task->todo($cbid);
    
        //succes
        $result = [
            "status" => "success",
            "message" => "unchecked"
        ];
    }
    
    catch( Throwable $t ){
        
        //error
         $result = [
            "status" => "error",
            "message" => "failed"
         ];
    }
    
    echo json_encode($result);
