<?php

class Image
{
    protected $newDirectory;
    protected $targetFile;
    protected $randomString;


    public function createDirectory($dir)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $charactersLength; ++$i) {
            $this->randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $this->newDirectory = 'uploads/'.$dir.DIRECTORY_SEPARATOR.$this->randomString;
        mkdir($this->newDirectory, 0777, true);
    }

    public function checkType($newImage)
    {
        $this->targetFile = basename($newImage['name']);
        $imageFileType = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));

        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'pdf') {
            return false;
        } else {
            return true;
        }
    }

    public function fileExists()
    {
        if (file_exists($this->newDirectory)) {
            return true;
        } else {
            return false;
        }
    }

    public function uploadImage()
    {
        $target_dir = $this->newDirectory;
        $target_file = $target_dir.DIRECTORY_SEPARATOR.basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        return $target_file;
    }

    public function insertIntoDB($filePath, $rowid)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO tl_uploads (image, task_id, active) VALUES (:path, :taskid,  1)");
        $statement->bindParam(':path', $filePath);
        $statement->bindParam(':taskid', $rowid);
        $statement->execute();

    }

    public static function getImage($rowid)
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM tl_uploads WHERE tl_uploads.task_id = :tid AND active = 1");
            $statement->bindParam(':tid', $rowid);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        } catch (Trowable $t) {
            return false;
        }
    }


    public function delete($rowid)
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE tl_uploads SET active = '0' WHERE tl_uploads.task_id = :tid");
            $statement->bindParam(':tid', $rowid);
            $result = $statement->execute();
        } catch (Throwable $t) {
            return false;
        }
    }

}
