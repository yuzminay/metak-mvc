<?php

class PostController extends Controller
{
  public function defaultAction()
  {
    # Getting Database Connection
    $dbh = DatabaseConnection::getInstance();
    $dbc = $dbh->getConnection();

    $postModel = new Post($dbc);

    # limit post per page
    $limit = 5;

    # setting page env for url
    if (isset($_GET["page"])) {
      $page  = $_GET["page"];
    } else {
      $page = 1;
    };

    # pagination logic
    $start_from = ($page - 1) * $limit;


    $posts = $postModel->findAllPerPage($start_from, $limit);

    $total_records_return = $postModel->countTable();
    $total_records        = $total_records_return[0]["COUNT(id)"];

    $total_pages          = ceil($total_records / $limit);

    $template = new Template('default'); #choosing template
    $template->view('post/index', [
      'posts' => $posts,
      'total_pages' => $total_pages,
    ]);
  }

  public function createAction()
  {
    # Getting Database Connection
    $dbh = DatabaseConnection::getInstance();
    $dbc = $dbh->getConnection();

    if (isset($_POST["submit"])) {

      $post = new Post($dbc);

      $post->title    = $_POST['title'];
      $post->content  = $_POST['content'];
      $post->date     = $_POST['date'];
      $post->image    = $_POST['image'];

      $post->save();

      $template = new Template('default'); #choosing template
      $template->view('post/index', []);
    }


    $template = new Template('default'); #choosing template
    $template->view('post/create', []);
  }

  public function passAction()
  {
    if ($_POST['password'] == '123456789') {
      $template = new Template('default'); #choosing template
      $template->view('post/create', []);
    } else {
      $message = $_POST['password'] ? "incorrect password" : '';
      $template = new Template('default'); #choosing template
      $template->view('post/pass', [
        'message' => $message
      ]);
    }
  }
}
