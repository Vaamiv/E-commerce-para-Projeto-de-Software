<?php
require __DIR__.'/../bootstrap.php'; require_login();
// Permitir somente ADMIN (opcional):
if (($_SESSION['user']['role'] ?? '') !== 'ADMIN') { flash('Acesso negado.'); header('Location: ../dashboard.php'); exit; }

use App\Http\Container; use App\Security\Csrf;
$container=new Container(); $service=$container->userService(); $title='Cadastrar usuário - Commerce Module'; $data=[];
if($_SERVER['REQUEST_METHOD']==='POST'){
  if(!Csrf::check($_POST['_csrf']??'')){ $data['error']='Token CSRF inválido.'; }
  else {
    $name=$_POST['name']??''; $email=$_POST['email']??''; $password=$_POST['password']??''; $password2=$_POST['password2']??''; $role=$_POST['role']??'ADMIN';
    if($password!==$password2){ $data=compact('name','email','role'); $data['error']='As senhas não conferem.'; }
    else {
      try { $service->register($name,$email,$password,$role); $data['ok']='Usuário criado com sucesso!'; $data['name']=$data['email']=''; }
      catch(\Throwable $e){ $data=compact('name','email','role'); $data['error']=$e->getMessage(); }
    }
  }
}
require __DIR__.'/../../views/partials/header.php'; require __DIR__.'/../../views/users/form.php'; require __DIR__.'/../../views/partials/footer.php';
