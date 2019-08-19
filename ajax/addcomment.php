<?php
require_once("../bootstrap.php");
Session::check();

$error = '';
$message = '';

//get the taskid
$taskid = 1;

//check if there is content
if(empty($_POST["comment_content"]))
{
 $error .= 'Comment is required';
}
else
{
 $message = htmlspecialchars($_POST["comment_content"]);
}
var_dump($message);


//if there's no errors then:
if($error == '')
{
    $comment = new Comment;
    $c = $comment->addComment($message, $taskid);
    $error = 'Comment Added';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>