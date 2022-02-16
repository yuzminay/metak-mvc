<?php

class HomeController extends Controller
{
  public function defaultAction()
  {
    include ROOT_PATH . 'view/home/index.php';
  }
}
