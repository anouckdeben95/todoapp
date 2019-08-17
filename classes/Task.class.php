<?php
    //class List not possible, is reserved keyword
    //https://www.php.net/manual/en/reserved.keywords.php
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

        /**public function addTask($taskname, $dur, $dl, $listid, $userid){
            $conn = Db::getInstance();
        
            $sql = "INSERT INTO tl_lists(name, duration, deadline, list_id, user_id, done) 
            VALUES (:name, :duration, :deadline, :listid, :userid, 0)";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':duration', $dur);
            $statement->bindValue(':deadline', $dl);
            $statement->bindValue(':listid', $listid);
            $statement->bindValue(':userid', $userid);
            $result = $statement->execute();
            return $result;
           
        }**/



    }