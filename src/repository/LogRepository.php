<?php

class LogRepository extends PDORepository {

  private static $instance;

  public static function getInstance() {

    if (!isset(self::$instance)) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  private function __construct() {}

    public function set($rta) {
      $query = $this->query("INSERT INTO log (rta) VALUES (?);", [$rta]);
      return (boolean) $query;
    }




  }
