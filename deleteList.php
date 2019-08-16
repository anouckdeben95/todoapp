<?php
require_once('bootstrap.php');

    $listItemId = $_GET['id'];

    $conn = Db::getInstance();
    $sql = "UPDATE tl_lists
            SET active = 0
            WHERE id = $listItemId";
    $statement = $conn->prepare($sql);
    $statement->execute();
    
    header('Location: index.php');
