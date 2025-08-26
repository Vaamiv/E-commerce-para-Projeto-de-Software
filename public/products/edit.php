<?php require __DIR__.'/../bootstrap.php'; require_login(); use App\Http\Container; use App\Security\Csrf;
$container=new Container(); $service=$container->productService(); $err=null; $id=(int)($_GET['id']??0);
$p=$service->get($id); if(!$p){ flash('Produto não encontrado.'); header('Location: index.php'); exit; }
$data=['id'=>$p->id,'name'=>$p->name,'price'=>$p->price,'description'=>$p->description,'image_url'=>$p->image_url,'rating_avg'=>$p->rating_avg,'rating_count'=>$p->rating_count];
if($_SERVER['REQUEST_METHOD']==='POST'){
  if(!Csrf::check($_POST['_csrf']??'')){ $err='Token CSRF inválido.'; }
  else {
    $name=trim($_POST['name']??''); $price=(float)($_POST['price']??0);
    $description=trim($_POST['description']??'')?:null; $image_url=trim($_POST['image_url']??'')?:null;
    $rating_avg=strlen(trim($_POST['rating_avg']??''))?(float)$_POST['rating_avg']:null;
    $rating_count=strlen(trim($_POST['rating_count']??''))?(int)$_POST['rating_count']:null;
    if($name && $price>0){ $service->update($p->id,$name,$price,$description,$image_url,$rating_avg,$rating_count); flash('Produto atualizado com sucesso!'); header('Location: index.php'); exit; }
    else { $err='Preencha os campos obrigatórios.'; $data=compact('name','price','description','image_url','rating_avg','rating_count'); $data['id']=$p->id; }
  }
}
$title='Editar produto - Commerce Module'; require __DIR__.'/../../views/partials/header.php'; if($err) echo '<div class="alert alert-danger">'.htmlspecialchars($err).'</div>';
require __DIR__.'/../../views/products/form.php'; require __DIR__.'/../../views/partials/footer.php';
