<?php

class Post
{
  public $id;
  public $title;
  public $content;
  public $image;
  public $date;

  private $dbc;

  public function __construct($dbc)
  {
    $this->dbc = $dbc;
  }


  # Queries
  public function save()
  {
    if ($_FILES["image"]) {
      $target_dir = ROOT_PATH . "public/uploads/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Allow certain file formats
      if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
      ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
      } else {
        $temp = explode(".", $_FILES["image"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        // "http://<?= $_SERVER['SERVER_NAME'] /uploads/<?= $post['image'] 
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $newfilename)) {
          echo "The Image " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }
    }


    $newfilename = ($newfilename ? ('http://' . $_SERVER['SERVER_NAME'] . '/uploads/' . $newfilename) : $this->image);

    $sql  = "INSERT INTO posts (id, title, content, time, image) VALUES (NULL, '$this->title', '$this->content', '$this->date', '$newfilename')";

    $stmt = $this->dbc->prepare($sql);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function findAllPerPage($start_from, $limit)
  {
    $sql  = "SELECT * FROM posts ORDER BY id DESC LIMIT $start_from, $limit";
    $stmt = $this->dbc->prepare($sql);
    $stmt->execute();

    $posts = $stmt->fetchAll();

    return $posts;
  }

  public function countTable()
  {
    $sql  = "SELECT COUNT(id) FROM posts";
    $stmt = $this->dbc->prepare($sql);
    $stmt->execute();

    $posts = $stmt->fetchAll();

    return $posts;
  }

  public function findById($id)
  {

    $sql = "SELECT * FROM posts WHERE id = :id";
    $stmt =  $this->dbc->prepare($sql);
    $stmt->execute(['id' => $id]);

    $postData = $stmt->fetch();

    $this->id       = $postData['id'];
    $this->title    = $postData['title'];
    $this->content  = $postData['content'];
    $this->image    = $postData['image'];
    $this->date     = $postData['date'];
  }
}
