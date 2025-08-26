<?php require __DIR__.'/../bootstrap.php'; require_login(); use App\Http\Container; use App\Security\Csrf;
if(!Csrf::check($_GET['csrf']??'')){ flash('CSRF inválido.'); header('Location: index.php'); exit; }
$container=new Container(); $service=$container->productService(); $id=(int)($_GET['id']??0);
if($id>0){ $service->delete($id); flash('Produto excluído com sucesso!'); } header('Location: index.php'); exit;
