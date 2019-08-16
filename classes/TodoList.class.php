<?php
    //class List not possible, is reserved keyword
    //https://www.php.net/manual/en/reserved.keywords.php
    class TodoList
    {
        protected $userid;
        private $listname;

        public function getLists($userid){
            $conn = Db::getInstance();
            $sql = "SELECT tl_lists.id, tl_lists.name 
                    FROM tl_lists 
                    INNER JOIN tl_users 
                    ON tl_lists.user_id = tl_users.id
                    WHERE tl_users.id = :userid
                    AND tl_lists.active = 1";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':userid', $userid);
            $statement->execute();
            $result = $statement->fetchAll();

            return $result;
        }

        public function addList($listname, $userid){
            $conn = Db::getInstance();
        
            $sql = "INSERT INTO tl_lists(name, user_id, active) 
            VALUES (:listname, :userid, 1)";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':listname', $listname);
            $statement->bindValue(':userid', $userid);
            $result = $statement->execute();
            return $result;
           
        }



    }