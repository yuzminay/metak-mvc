<?php

final class DatabaseConnection #final for not being extended
{
  private static $instance = null;
  private static $connection;

  public static function getInstance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new DatabaseConnection();
    }
    return self::$instance;
  }

  private function __construct() #making shire this methods private
  {
  }

  private function __clone() #making shire this methods private
  {
  }

  private function __wakeup() #making shire this methods private
  {
  }

  public static function connect($host, $dbname, $user, $password)
  {
    self::$connection = new PDO("mysql:dbname=$dbname;host=$host", $user, $password);
  }

  public static function getConnection()
  {
    return self::$connection;
  }
}
