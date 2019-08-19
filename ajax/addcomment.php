<?php
require_once("../bootstrap.php");
Session::check();

if( !empty($_POST)) {
    //niet comment komt van ajax
    $message = htmlspecialchars($_POST['text']); 
    
    //get the taskid
    $taskid = 1;
    
    try {
        $comment = new Comment;
        $c = $comment->addComment($message, $taskid);
    
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