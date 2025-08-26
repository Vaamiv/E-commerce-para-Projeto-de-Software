<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
spl_autoload_register(function($class){ $prefix='App\\'; $base=__DIR__.'/../src/'; if(strncmp($prefix,$class,strlen($prefix))!==0) return; $rel=substr($class, strlen($prefix)); $file=$base.str_replace('\\','/',$rel).'.php'; if(file_exists($file)) require $file; });
function is_logged_in(): bool { return !empty($_SESSION['user']); }
function require_login(): void { if(!is_logged_in()){ header('Location: login.php'); exit; } }
function flash(?string $msg=null): ?string { if($msg!==null){ $_SESSION['_flash']=$msg; return null; } if(!empty($_SESSION['_flash'])){ $m=$_SESSION['_flash']; unset($_SESSION['_flash']); return $m; } return null; }
