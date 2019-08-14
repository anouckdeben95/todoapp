<?php
    //class List not possible, is reserved keyword
    //https://www.php.net/manual/en/reserved.keywords.php
    class TodoList
    {
        protected $userid;

        public function getLists($userid){
            $conn = Db::getInstance();
            $sql = "SELECT tl_lists.id, tl_lists.name 
                    FROM tl_lists 
                    INNER JOIN tl_users 
                    ON tl_lists.user_id = tl_users.id
                    WHERE tl_users.id = :userid";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':userid', $userid);
            $statement->execute();
            $result = $statement->fetchAll();

            return $result;
        }



    }