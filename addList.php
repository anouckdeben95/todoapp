<?php require_once("bootstrap.php");
$s = Session::check();
if($s === false){
    header("Location: login.php");
}
else{
    if(!empty($_POST)) {
        $listname = str_replace(array("'", "\"", "&quot;"), "", htmlspecialchars ($_POST['listname']));
    
        $id = $_SESSION['userID'];
        $list = new Todolist();
    
        if ( $list->addList($listname, $id)) {
            header("Location: index.php");
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
        <h2>New list</h2>
        <?php if(isset($feedback)): ?>
            <div>
                <p><?php echo $feedback; ?></p>
            </div>
        <?php endif; ?>

                <input type="text" id="listname" name="listname" placeholder="Listname"><br>
                  
                <input class="add_list" type="submit" value="Add">
                <br>
    </form>
    </main>
	</body>
</html>