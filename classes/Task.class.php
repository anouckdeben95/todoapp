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
                    case 
                        when tl_tasks.done = 1 then 3
                        when tl_tasks.deadline = '00000000' then 2
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

        public function updateDeadline($id, $newdl){
            $conn = Db::getInstance();
            $sql = "UPDATE tl_tasks
                    SET deadline = :ndl
                    WHERE tl_tasks.id = :id";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':ndl', $newdl);
            $statement->bindValue(':id', $id);
            $result = $statement->execute();
            return $result;  
        }

        public static function timeLeft($deadline){
            date_default_timezone_set('Europe/Brussels');   
            $today = strtotime(date("Ymd")); //current date
            $dl = strtotime($deadline);
            if($deadline != '0000-00-00'){
                $timeleft = $today-$dl;
                $daysleft = round((($timeleft/24)/60)/60); 
                if ($daysleft < 0){
                    $d = abs($daysleft);
                    if($daysleft == 1){
                        $days = $d ." day left!";
                    } else{
                        $days = $d ." days left!";
                    }
                } else {
                    if ($daysleft == 0){
                        $days = "TODAY!";
                    } else{
                        if($daysleft == 1){
                            $days = $daysleft ." day too late!";
                        } else{
                            $days = $daysleft ." days too late!";
                        }
                    }
                }
                return $days;
                
            } else {
                $days = "";
                return $days;
            }
        }

        public static function timeNeeded($dur){
            if ($dur <= 30){
                $pressure = "<p style='color:#3895D3'>".$dur."</p>";
            } else{
                if ($dur >= 60){
                    $pressure = "<p style='color:#BF0000'>".$dur."</p>";
                } else{
                    $pressure = "<p style='color:#E8C547'>".$dur."</p>";
                }

            }
            return $pressure;
        }

        public function checkDouble($tname, $listid){
            $conn = Db::getInstance();
            $sql = "SELECT * 
                    FROM tl_tasks
                    WHERE tl_tasks.name = :tname
                    AND tl_tasks.list_id = :listid";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':tname', $tname);
            $statement->bindValue(':listid', $listid);
            $result = $statement->execute();
            if ($statement->rowCount() > 0){
                $r = false;
                return $r;
            } else {
                $r = true;
                return $r;
            }
            
        }

    }