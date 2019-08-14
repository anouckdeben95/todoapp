<?php
    class Lists
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