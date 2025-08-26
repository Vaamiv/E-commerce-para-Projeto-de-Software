<?php
namespace App\Config;
use PDO; use PDOException;
class Database {
  private static ?PDO $instance = null;
  private function __construct() {} private function __clone() {}
  public static function getConnection(): PDO {
    if (self::$instance === null) {
      $config = require __DIR__ . '/env.php'; $db = $config['db'];
      $dsn = sprintf('%s:host=%s;port=%d;dbname=%s;charset=%s',$db['driver'],$db['host'],$db['port'],$db['database'],$db['charset']);
      try {
        self::$instance = new PDO($dsn, $db['username'], $db['password'], [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);
      } catch (PDOException $e) { die('Erro de conexão com o banco: ' . $e->getMessage()); }
    } return self::$instance;
  }
}
