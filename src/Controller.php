<?php

class Controller
{
  function runAction($actionName)
  {

    // if (method_exists($this, 'runBeforeAction')) {
    //   $this->runBeforeAction();
    // }

    $actionName = $actionName . 'Action';
    if (method_exists($this, $actionName)) {
      $this->$actionName();
    } else {
      include 'view/404.html';
    }
  }
}
