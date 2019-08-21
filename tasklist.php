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
    <link rel = "stylesheet" type = "text/css" href = "css/add.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/popup.css"/>
    <style>
        .commentbtn{
            display: none;
        }
        .color{
            background-color: #50C878;
        }
        table{
            border-collapse: collapse;
        }
        .listing tbody tr:nth-child(odd){
            border-bottom: 5px solid #4D5061;
        }
    </style>


    <title>TodoApp - tasklist</title>

</head>
<body>
    <header>
        <?php 
            $id = $_SESSION['userID'];
            $a = new Admin();
            $isAdmin = $a->checkAdmin($id);
            if ($isAdmin){
                require_once("nav2.inc.php");
            } else {
                require_once("nav.inc.php");
            }
         ?>
        <h1>Tasks</h1>
    </header>
    <main>
        <div class="white">
        <input type='submit' class='btn' value='Add task' onClick="window.location.href='addTask.php?id=<?php echo $listItemId; ?>'"><br>
        <input type='submit' class='sort' value='Sort on workhours' onClick=""><br>

        <table class="listing" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
        <th>Done</th>
        <th>Tasks</th>
        <th>Duration (min)</th>
        <th class='dl'>Deadline</th>
        <th></th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach($results as $row)
        {
            $days = Task::timeLeft($row['deadline']);
            $time = Task::timeNeeded($row['duration']);
            if ($row['done'] == 1){
                $k = "color";
                $check = 'checked="checked"';
            }
            else{ $k=""; $check=""; }
            if ($row['deadline'] == '0000-00-00'){
                $showdl = "";
            } else {
                $showdl = $row['deadline'];
            }
            echo "<tr class='". $k ."'>";
            echo "<td><input type='checkbox'". $check ."class='check' name='checkbox' id=". $row['id'] ."></td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $time . "</td>";
            echo "<td>" . $showdl . "<p style='font-weight:bold'>". $days ."</p><br>
            <a onclick='openPopup(". $row['id'] .")'><img src='images/edit_icon_s.png'></a></td>";
            echo "<td><a onclick='openComments(". $row['id'] .")'>
            <img src='images/add_icon_s.png'></a></td>";
            echo "</tr>";

            echo "<tr id='commentbtn". $row['id'] ."' class='commentbtn'><td colspan='4'>";
            ?>
                <ul id="listupdates" class="updates">
                    <?php 
                        $taskid = $row['id'];
                        $comments = run($taskid);
                        foreach($comments as $com) {
                            echo "<li>". $com['message'] ."</li>";
                        }
                        

		            ?>
		        </ul>
                <form method="POST" class="comment">
                    <?php //echo "<p style='display: none;' id='aid". $row['id'] ."'>".$taskid."</p>" ?>
                    <textarea id="comment" name="comment_content" class="form-control" placeholder="Enter Comment" rows="1"></textarea>
                    <?php echo "<input type='submit' id=". $row['id'] ." name='submit' class='btn submit' value='Submit' />" ?>
                </form>
                <span id="display_comment"></span>
            <?php
            echo "</td>
            </tr>";

            ?>
            <!-- popup -->
                <div id="modal<?php echo $row['id'] ?>" class="modal">
                    <div class="popup">
                        <?php echo "<span onclick='closing(". $row['id'] .")' class='close' >&times;</span>"; ?>
                        <form action="" method="post" class="update">
                        <?php if(isset($feedback)){
                            echo "<div>
                            <p>". $feedback ."</p>
                            </div>";
                        } ?>
                        
                            <h1>Task:</h1><br>
                            <p><?php echo $row['name'] ?></p><br> 
                            <label>New Deadline<label><br>
                            <div class="up">
                                <input type="date" id="newdeadline" name="newdeadline"><br>

                                <input class="update_task" type="submit" value="Update" id="<?php echo $row['id'] ?>">
                            </div>
                        </form>
                    </div>
                </div>

        <?php    

        }
        ?>
        </tbody>
        </table>
    </div>
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

    function openPopup(rowid) {
        var id = "modal".concat(rowid);
        
        console.log(id);
        // Get the modal
        var modal = document.getElementById(id);
        modal.style.display = "block";
    }

    function closing(rowid) {
        var id = "modal".concat(rowid);
        console.log(id);
        var modal = document.getElementById(id);
        modal.style.display = "none";
    }
   




    


</script>
<script src="js/comment.js"></script>
<script src="js/checked.js"></script>
<script src="js/update.js"></script>
</html>