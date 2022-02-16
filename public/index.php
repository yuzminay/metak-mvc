<?php

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);


$section = $_GET['section'] ?? $_POST['section'] ?? 'home';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';


if ($section == 'post') {
  echo "Post Page";
} else {
  include ROOT_PATH . 'controller/HomeController.php';

  $homeController = new HomeController();
  $homeController->defaultAction();
}
