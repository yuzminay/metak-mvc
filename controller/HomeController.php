<?php

class HomeController extends Controller
{
  public function defaultAction()
  {

    $template = new Template('default'); #choosing template
    $template->view('home/index', []);
  }
}
