<?php

class ApiController extends Controller
{
  public function createAction()
  {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $dbh = DatabaseConnection::getInstance();
    $dbc = $dbh->getConnection();

    $post = new Post($dbc);
    $data = json_decode(file_get_contents("php://input"));

    $post->title = $data->title;
    $post->content = $data->content;
    $post->image = $data->image;
    $post->date = date('Y-m-d H:i:s');

    if ($post->save()) {
      echo "Post inserted";
    } else {
      echo "There is Error in insert";
    }
  }
}
