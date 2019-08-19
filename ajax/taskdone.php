<?php
require_once("../bootstrap.php");
Session::check();

$cbid = $_POST['cbid'];
    
    try {
        $task = new Task;
        $t = $task->done($cbid);
    
        //succes
        $result = [
            "status" => "success",
            "message" => "checked"
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
