<?php

class PostController extends Controller
{
  public function defaultAction()
  {

    $template = new Template('default'); #choosing template
    $template->view('post/index', []);
  }
}
