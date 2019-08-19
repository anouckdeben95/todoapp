<?php
    require_once("bootstrap.php");

    $listItemId = $_GET['id'];

    $t = new Task;   
    $results = $t->getTasks($listItemId);


    function run($taskid){
    $c = new Comment;
    $comments = $c->getComments($taskid);
    return $comments;
    }


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
        .commentbtn{
            display: none;
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
            echo "<td class='check'>check</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['duration'] . "</td>";
            echo "<td>" . $row['deadline'] . "</td>";
            echo "<td><a onclick='openComments(". $row['id'] .")'>
            <img src='images/add_icon_s.png'></a></td>";
            echo "</tr>";

            echo "<tr id='commentbtn". $row['id'] ."' class='commentbtn'><td colspan='4'>";
            ?>
                <ul id="listupdates">
                    <?php 
                        $taskid = $row['id'];
                        $comments = run($taskid);
                        foreach($comments as $com) {
                            echo "<li>". $com['message'] ."</li>";
                        }
                        

		            ?>
		        </ul>
                <form method="POST" class="comment">
                    <textarea id="comment" name="comment_content" class="form-control" placeholder="Enter Comment" rows="1"></textarea>
                    <input type="submit" id="submit" name="submit" class="btn" value="Submit" />
                </form>
                <span id="display_comment"></span>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    function openComments(rowid) {

        var id = "commentbtn".concat(rowid);

        if (document.getElementById(id).classList.contains('commentbtn')) {
            document.getElementById(id).classList.remove("commentbtn");

        } else {
            document.getElementById(id).classList.add("commentbtn");
        }

    }
</script>
<script src="js/comment.js"></script>
</html>