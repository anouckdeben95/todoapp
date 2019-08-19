<?php require_once("bootstrap.php");
$s = Session::check();
if($s === false){
    header("Location: login.php");
}
else{
    if(!empty($_POST)) {
        $taskname = str_replace(array("'", "\"", "&quot;"), "", htmlspecialchars ($_POST['taskname']));
        $dur = str_replace(array("'", "\"", "&quot;"), "", htmlspecialchars ($_POST['duration']));
        $dl = str_replace(array("'", "\"", "&quot;"), "", htmlspecialchars ($_POST['deadline']));
    
        $userid = $_SESSION['userID'];
        $listid = $_GET['id'];
        $task = new Task();
    
        if ( $task->addTask($taskname, $dur, $dl, $userid, $listid)) {
            header("Location: tasklist.php?id=".$listid);
        } else {
            $feedback = "Can't add this list at the moment. Try again later!";
        }
     
    }
}


?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
        <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
    

        <title>TodoApp</title>

    </head>
	<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
    </header>
    <main>

    <form action="" method="post" class="add_form">
        <h2>New task</h2>
        <?php if(isset($feedback)): ?>
            <div>
                <p><?php echo $feedback; ?></p>
            </div>
        <?php endif; ?>

                <input type="text" id="taskname" name="taskname" placeholder="Task"><br>
                <input type="text" id="duration" name="duration" placeholder="Duration"><br>
                <label for="dl">Deadline</label>
                <input type="date" id="deadline" name="deadline"><br>             
                  
                <input class="add_list" type="submit" value="Add">
                <br>
    </form>
    </main>
	</body>
</html>