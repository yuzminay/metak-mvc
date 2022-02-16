<?php

class PostController extends Controller
{
  public function defaultAction()
  {
    # Getting Database Connection
    $dbh = DatabaseConnection::getInstance();
    $dbc = $dbh->getConnection();

    $postModel = new Post($dbc);
    // $postModel->findById(1);

    // $title = $postModel->title;
    // $content = $postModel->content;
    // $time = $postModel->time;
    // $image = $postModel->image;

    $template = new Template('default'); #choosing template
    $template->view('post/index', []);
  }
}
