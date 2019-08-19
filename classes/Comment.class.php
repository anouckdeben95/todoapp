<?php

    class Comment
    {
        protected $taskid;
        private $comment;

        public function getComments($taskid){
            $conn = Db::getInstance();
            $sql = "SELECT tl_comments.task_id, tl_comments.message 
                    FROM tl_comments 
                    INNER JOIN tl_tasks 
                    ON tl_comments.task_id = tl_tasks.id
                    WHERE tl_tasks.id = :taskid";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':taskid', $taskid);
            $statement->execute();
            $result = $statement->fetchAll();

            return $result;
        }

        public function addComment($comment, $taskid){
            $conn = Db::getInstance();
            $sql = "INSERT INTO tl_comments(message, task_id) 
            VALUES (:mess, :taskid)";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':mess', $comment);
            $statement->bindValue(':taskid', $taskid);
            $statement->execute();
        }





    }