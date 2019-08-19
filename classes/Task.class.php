<?php

    class Task
    {
        protected $listItemId;
        private $listname;

        public function getTasks($listItemId){
            $conn = Db::getInstance();
            $sql = "SELECT tl_tasks.id, tl_tasks.name, tl_tasks.duration, tl_tasks.deadline 
                    FROM tl_tasks 
                    INNER JOIN tl_lists 
                    ON tl_tasks.list_id = tl_lists.id
                    WHERE tl_lists.id = :taskid";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':taskid', $listItemId);
            $statement->execute();
            $result = $statement->fetchAll();

            return $result;
        }

        public function addTask($taskname, $dur, $dl, $userid, $listid){
            $conn = Db::getInstance();
        
            $sql = "INSERT INTO tl_tasks(name, duration, deadline, user_id, list_id, done) 
            VALUES (:tname, :duration, :deadline, :userid, :listid, 0)";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':tname', $taskname);
            $statement->bindValue(':duration', $dur);
            $statement->bindValue(':deadline', $dl);
            $statement->bindValue(':userid', $userid);
            $statement->bindValue(':listid', $listid);
            $result = $statement->execute();
            return $result;
           
        }



    }