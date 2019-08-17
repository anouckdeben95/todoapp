<?php
    require_once("bootstrap.php");

    $listItemId = $_GET['id'];

    $t = new Task;   
    $results = $t->getTasks($listItemId);


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>
    <style>
    main{
            max-width: 500px;
            margin: auto;
        }
    input.btn{
            background-color: #E8C547;
            width: 50%;
            margin: 20px 25% 20px 25%;
            display: inline-block;
            cursor: pointer;
            color: #FFFFFF;
            font-size: 14px;
            padding: 8px 18px;
            text-decoration: none;
            text-transform: uppercase;
        }
    input.btn:hover{
            background:linear-gradient(to bottom, #E8C547 5%, rgb(235, 209, 115) 100%);
	        background-color:#34CACA;
        }
    .listing{
            margin: auto;
    }
    .listing td{
        padding: 10px;
        text-align: center;
    }

    </style>


    <title>TodoApp - tasklist</title>

</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
        <h1>Tasks</h1>
    </header>
    <main>
        <input type="submit" class="btn" value="Add task" onClick="window.location.href='addlist.php'"><br>

        <table class="listing">
        <thead>
        <tr>
        <th>Check</th>
        <th>Tasks</th>
        <th>Duration</th>
        <th class='dl'>Deadline</th>
        <th></th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach($results as $row)
        {
            echo "<tr>";
            echo "<td>check</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['duration'] . "</td>";
            echo "<td>" . $row['deadline'] . "</td>";
            echo "<td><a href='deleteList.php?id=". $row['id'] ."'>
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