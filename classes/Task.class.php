<?php

    class Task
    {
        protected $listItemId;
        private $listname;

        public function getTasks($listItemId){
            $conn = Db::getInstance();
            //https://stackoverflow.com/questions/46339436/sql-order-by-0-first-and-then-descend-number-values/46339453
            $sql = "SELECT tl_tasks.id, tl_tasks.name, tl_tasks.duration, tl_tasks.deadline, tl_tasks.done 
                    FROM tl_tasks 
                    INNER JOIN tl_lists 
                    ON tl_tasks.list_id = tl_lists.id
                    WHERE tl_lists.id = :taskid
                    ORDER BY 
                    case when tl_tasks.done = 0 then 0
                    else 1 end, tl_tasks.deadline ASC";
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

        public function done($id){
            $conn = Db::getInstance();
            $sql = "UPDATE tl_tasks
                    SET done = 1
                    WHERE tl_tasks.id = :id";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $id);
            $result = $statement->execute();
            return $result;         
        }

    }