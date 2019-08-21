<?php
    require_once("bootstrap.php");

    $s = Session::check();
    if($s === false){
        header("Location: login.php");
    }
    else{
        $id = $_SESSION['userID'];
        $u = new User();
        $results = $u->getUsers();
    }

    $curUsers = User::userCount();
    $curLists = ToDoList::listCount();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/add.css"/>
    <style>
        span{
           margin-left: 20px;
        }
        p{
            display: inline;
            font-weight: bold;
        }

    </style>

    <title>TodoApp - admin</title>

</head>
<body>
    <header>
        <?php require_once("nav2.inc.php"); ?>
        <h1>Admin</h1>
    </header>
    <main>
        <div class="whitelist">
        <h1>Users</h1>
        <p>Manage the admins</p>
        <table class="listing">
        <thead>
        <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Username</th>
        <th>Admin<th>
        <th></th>
        <th></th>
        </tr>
        </thead>
        
        <tbody>
        <?php
        foreach($results as $row)
        {
            if($row['isAdmin']){
                $ad = "Yes";
            } else {
                $ad ="No";
            }
            echo "<tr>";
            echo "<td>" . $row['firstname'] . "</td>";
            echo "<td>" . $row['lastname'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $ad . "</td>";
            echo "<td><input type='submit' id='".$row['id']."' class='btn addbtn' value='ADD'></td>";
            echo "<td><input type='submit' id='".$row['id']."' class='btn rembtn' value='REMOVE'></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
        </table>
        <h1>Stats</h1>
        <p>Current users:</p>
        <span><?php echo $curUsers[0][0];?></span><br>
        <p>Total lists:</p>
        <span><?php echo $curLists[0][0]; ?></span><br>
        </div>
    </main>
    <footer>

    </footer>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/admin.js"></script>

</html>