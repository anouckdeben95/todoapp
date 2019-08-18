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
    <link rel = "stylesheet" type = "text/css" href = "css/tasks.css"/>
    <style>
    

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
            echo "<td class='check'>check</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['duration'] . "</td>";
            echo "<td>" . $row['deadline'] . "</td>";
            echo "<td><a onclick='openComments()'>
            <img src='images/add_icon_s.png'></a></td>";
            echo "</tr>";

            echo "<tr style='display:none;' id='commentbtn'>
      
            <td colspan='4' class='comments'>";
            ?>
                <form method="POST" class="comment">
                    <textarea name="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
                    <input type="submit" name="submit" class="btn" value="Submit" />
                </form>

            <?php
            echo "</td></tr>";
        }
        ?>
        </tbody>
        </table>
    </main>
    <footer>

    </footer>

</body>
<script type="text/javascript">
    function openComments() {
        if (document.getElementById('commentbtn').style.display == "none") {
            document.getElementById('commentbtn').style.display = "block";

        } else {
            document.getElementById('commentbtn').style.display = "none";
        }
    }
</script>
</html>