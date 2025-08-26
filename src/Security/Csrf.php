<?php
namespace App\Security;
class Csrf {
  public static function token(): string { if(session_status()!==PHP_SESSION_ACTIVE) session_start(); if(empty($_SESSION['_csrf'])) $_SESSION['_csrf']=bin2hex(random_bytes(32)); return $_SESSION['_csrf']; }
  public static function input(): string { return '<input type="hidden" name="_csrf" value="'.htmlspecialchars(self::token()).'">'; }
  public static function check(?string $v): bool { if(session_status()!==PHP_SESSION_ACTIVE) session_start(); return isset($_SESSION['_csrf']) && hash_equals($_SESSION['_csrf'], (string)$v); }
}
