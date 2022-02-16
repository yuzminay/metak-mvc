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
}
