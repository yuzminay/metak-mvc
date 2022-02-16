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
