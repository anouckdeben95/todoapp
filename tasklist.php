<?php
    require_once("bootstrap.php");

    $s = Session::check();
    if($s === false){
        header("Location: login.php");
    } else {    
        $listItemId = $_GET['id'];

        $t = new Task;   
        $results = $t->getTasks($listItemId);
    }

    function run($taskid){
        $c = new Comment;
        $comments = $c->getComments($taskid);
        return $comments;
    }

    //upload image to DB
    //https://justclack.blogspot.com/2017/08/image-upload-in-php-pdo-with-database.html
    if(isset($_POST['uploadbtn'])) { 

        $newImage = $_FILES['image'];
        $rowidimage = $_POST['rowid'];

        $image = new Image();
        if ($image->checkType($newImage) === false) {
            $feedback = 'Sorry, only JPG, JPEG, PNG & PDF files are allowed.';
        } else {
            $image->createDirectory('images');
            if ($image->fileExists() === false) {
                $feedback = 'Sorry, this file already exists. Please try again.';
            } else {
                $image->insertIntoDB($image->uploadImage(), $rowidimage);
                $feedback = 'File has been uploaded.';
                header("Location: tasklist.php?id=".$listItemId);
            }
                            
        } 
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
        .listing tbody .mainrow{
            border-bottom: 5px solid #4D5061;
        }
        .upload{
            display: none; 
            position: fixed;
            z-index: 1; /* Sit on top */
            padding-top: 100px; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%; 
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .image{
            width: 200px;
            height: auto;
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
        <!--<input type='submit' name='sort' class='sort' value='Sort on workhours' id="<?php echo $listItemId; ?>"><br>-->

        <table class="listing" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
        <th>Done</th>
        <th>Tasks</th>
        <th>Duration (min)</th>
        <th class='dl'>Deadline</th>
        <th></th>
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
            <a class='pen' onclick='openPopup(". $row['id'] .")'><img src='images/edit_icon_s.png'></a></td>";
            echo "<td><a onclick='openComments(". $row['id'] .")'>
            <img src='images/add_icon_s.png'></a></td>";
            echo "<td><a onclick='openUpload(". $row['id'] .")'>
            <img src='images/addimage_icon_s.png'></a></td>";
            echo "</tr>";

            $image = new Image;
            $i = $image->getImage($row['id']);
            foreach($i as $img){
            echo "<tr class='mainrow ". $k ."'>
            <td colspan='4'><img class='image' src='". $img['image'] ."'></td>";?>
            <?php echo "<td colspan='2'><input style='width: 30px;' name='imgrembtn' class='btn imgbtn' value='DEL' id=". $row['id'] ."></td>
            </tr>";
            }

            echo "<tr id='commentbtn". $row['id'] ."' class='commentbtn'><td colspan='6'>";
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

            <!-- Upload popup -->
                <div id="upload<?php echo $row['id'] ?>" class="upload">
                    <div class="popup">
                        <?php echo "<span onclick='closing2(". $row['id'] .")' class='close' >&times;</span>"; ?>
                        <form action="" method="post" class="update" enctype="multipart/form-data">
                        <?php if(isset($feedback)){
                            echo "<div>
                            <p>". $feedback ."</p>
                            </div>";
                        } ?>
                            <input type="file" name="image" id="upFile" accept=".png,.gif,.jpg,.webp" required><br>
                            <input style='display: none;' type="text" name="rowid" value="<?php echo $row['id'] ?>">
                            <input type="submit" name="uploadbtn" value="Upload Image" id=""> 
                        
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

    function openUpload(rowid) {
        var id = "upload".concat(rowid);
        
        console.log(id);
        // Get the modal
        var upl = document.getElementById(id);
        upl.style.display = "block";
    }

    function closing2(rowid) {
        var id = "upload".concat(rowid);
        console.log(id);
        var upl = document.getElementById(id);
        upl.style.display = "none";
    }
   




    


</script>
<script src="js/comment.js"></script>
<script src="js/checked.js"></script>
<script src="js/update.js"></script>
<script src="js/delete.js"></script>
</html>