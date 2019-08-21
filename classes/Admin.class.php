<?php

    class Admin
    {
        
        public function checkAdmin($userid){
            $conn = Db::getInstance();
            $sql = "SELECT * 
                    FROM tl_users
                    WHERE tl_users.id = :userid
                    AND tl_users.isAdmin = 1";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':userid', $userid);
            $result = $statement->execute();
            if ($statement->rowCount() > 0){
                $r = true;
                return $r;
            } else {
                $r = false;
                return $r;
            }
        }

        public function makeAdmin($userid){
            $conn = Db::getInstance();
            $sql = "UPDATE tl_users
                    SET isAdmin = 1
                    WHERE tl_users.id = :id";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $userid);
            $result = $statement->execute();
            return $result; 
        }

        public function removeAdmin($userid){
            $conn = Db::getInstance();
            $sql = "UPDATE tl_users
                    SET isAdmin = 0
                    WHERE tl_users.id = :id";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $userid);
            $result = $statement->execute();
            return $result; 
        }


    }