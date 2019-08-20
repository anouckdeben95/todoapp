<?php
require_once("../bootstrap.php");
Session::check();

if(!empty($_POST)){

    //niet comment komt van ajax
    $newdl = htmlspecialchars($_POST['date']); 
    
    //get the taskid
    $taskid = $_POST['taskid'];
        
    try {
        $task = new Task;
        $ta = $task->updateDeadline($taskid, $newdl);
        
        //succes
        $result = [
            "status" => "success",
            "message" => "comment was saved"
        ];
    }
        
    catch( Throwable $t ){
            
        //error
        $result = [
            "status" => "error",
            "message" => "comment wasn't saved"
        ];
    }
        
    echo json_encode($result);

}