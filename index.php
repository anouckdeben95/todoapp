<?php
    require_once("bootstrap.php");

    $s = Session::check();
    if($s === false){
        header("Location: login.php");
    }
    else{
        $id = $_SESSION['userID'];

        $l = new TodoList();
        $results = $l->getLists($id);
    }

    
    
?><!DOCTYPE html>
<html lang="en">
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

        <button onClick="window.location.href='addlist.php'">Add list</button>

        <table>
        <thead>
        <tr>
        <th>Lists</th>
        <th></th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach($results as $row)
        {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td><a href='deleteList.php?id=". $row['id'] ."' onclick='deleteList()'>
                <img src='images/trashcan_icon_s.png'></a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
        </table>
    </main>
    <footer>

    </footer>

</body>



</html>