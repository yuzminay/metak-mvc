<?php

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

# Main Controller which all controller will extend this
require_once ROOT_PATH . 'src/Controller.php';

require_once ROOT_PATH . 'src/Template.php';

require_once ROOT_PATH . 'model/Post.php';

require_once ROOT_PATH . 'src/DatabaseConnection.php';

# DATABASE CONNECTION
# Taking db info dbn, host, username, pass
$dbCredentials = include ROOT_PATH . 'src/dbCredentials.php';
# Database Connection
DatabaseConnection::connect($dbCredentials['host'], $dbCredentials['dbn'], $dbCredentials['user'], $dbCredentials['password']);

# Section is the page name, Action is the page controller action which will include suitable view
# url: https:metak-mvc.test/?section=home&&action=default
$section = $_GET['section'] ?? $_POST['section'] ?? 'home';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';


# If Else Router
if ($section == 'post') {

  include ROOT_PATH . 'controller/PostController.php';

  $currController = new PostController();
  $currController->runAction($action);
} else if ($section == 'api') {
  include ROOT_PATH . 'controller/ApiController.php';

  $currController = new ApiController();
  $currController->runAction($action);
} else {

  include ROOT_PATH . 'controller/HomeController.php';

  $currController = new HomeController();
  $currController->runAction($action);
}
