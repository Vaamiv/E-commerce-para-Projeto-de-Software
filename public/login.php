<?php
require __DIR__.'/bootstrap.php';
use App\Http\Container; use App\Security\Csrf;
$container=new Container(); $err=null;
if($_SERVER['REQUEST_METHOD']==='POST'){
  if(!Csrf::check($_POST['_csrf']??'')){ $err='Token CSRF inválido.'; }
  else { $email=trim($_POST['email']??''); $password=$_POST['password']??''; $auth=$container->authService(); $user=$auth->login($email,$password);
    if($user){ $_SESSION['user']=['id'=>$user->id,'name'=>$user->name,'email'=>$user->email,'role'=>$user->role]; header('Location: dashboard.php'); exit; }
    else { $err='Credenciais inválidas.'; }
  }
}
?><!doctype html><html lang="pt-br"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - Commerce Module</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><div class="container py-5"><div class="row justify-content-center"><div class="col-12 col-md-5">
<div class="card shadow-sm"><div class="card-body p-4"><h1 class="h4 mb-3 text-center">Commerce Module</h1>
<?php if($err): ?><div class="alert alert-danger"><?= htmlspecialchars($err) ?></div><?php endif; ?>
<form method="post" class="vstack gap-3"><?= App\Security\Csrf::input() ?>
<div><label class="form-label">E-mail</label><input type="email" name="email" class="form-control" required></div>
<div><label class="form-label">Senha</label><input type="password" name="password" class="form-control" required></div>
<button class="btn btn-primary w-100">Entrar</button></form></div></div>
<p class="text-center text-muted mt-3" style="font-size:.9rem;">Usuário seed: admin@example.com / admin123</p>
<div class="text-center"><a href="catalog.php" class="small">Ir para Catálogo Público</a></div>
</div></div></div></body></html>
