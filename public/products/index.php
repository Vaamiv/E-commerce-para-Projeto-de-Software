<?php require __DIR__.'/../bootstrap.php'; require_login(); use App\Http\Container;
$container=new Container(); $service=$container->productService(); $products=$service->list();
$title='Produtos - Commerce Module'; require __DIR__.'/../../views/partials/header.php'; require __DIR__.'/../../views/partials/flash.php'; ?>
<?php include __DIR__.'/../../views/products/index.php'; ?>
<?php require __DIR__.'/../../views/partials/footer.php'; ?>
