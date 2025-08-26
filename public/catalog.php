<?php require __DIR__.'/bootstrap.php'; use App\Http\Container; $container=new Container(); $service=$container->productService(); $products=$service->list(); ?>
<!doctype html><html lang="pt-br"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Loja Gamer - Catálogo</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><nav class="navbar navbar-expand-lg bg-dark navbar-dark"><div class="container">
<a class="navbar-brand" href="catalog.php">Loja Gamer</a>
<form class="ms-auto" role="search" onsubmit="return false;"><input id="searchInput" class="form-control" type="search" placeholder="Buscar produto..." aria-label="Buscar" style="width:260px"></form>
<div class="ms-2"><a class="btn btn-outline-light btn-sm" href="login.php">Admin</a></div>
</div></nav>
<div class="container py-4"><div class="row g-3">
<?php foreach($products as $p): $d=['id'=>$p->id,'name'=>$p->name,'price'=>$p->price,'description'=>$p->description,'image_url'=>$p->image_url,'rating_avg'=>$p->rating_avg,'rating_count'=>$p->rating_count]; $json=htmlspecialchars(json_encode($d),ENT_QUOTES,'UTF-8'); ?>
  <div class="col-12 col-sm-6 col-md-4 col-lg-3" data-card-name="<?= htmlspecialchars($p->name) ?>">
    <div class="card h-100 shadow-sm">
      <?php if($p->image_url): ?><img src="<?= htmlspecialchars($p->image_url) ?>" class="card-img-top" alt="<?= htmlspecialchars($p->name) ?>" style="height:220px;object-fit:cover;"><?php endif; ?>
      <div class="card-body d-flex flex-column">
        <h5 class="card-title mb-1"><?= htmlspecialchars($p->name) ?></h5>
        <div class="text-warning small mb-1">
          <?php if($p->rating_avg!==null): ?><?= number_format($p->rating_avg,1,',','.') ?> ⭐ / 5 <span class="text-muted">(<?= (int)($p->rating_count ?? 0) ?>)</span><?php else: ?><span class="text-muted">Sem avaliações</span><?php endif; ?>
        </div>
        <strong class="mb-2">R$ <?= number_format($p->price,2,',','.') ?></strong>
        <button class="btn btn-outline-primary mt-auto" data-product='<?= $json ?>'>Ver detalhes</button>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div></div>
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content">
  <div class="modal-header"><h5 class="modal-title" id="modalTitle">Detalhes do Produto</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
  <div class="modal-body" id="modalBody"></div>
  <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button><button type="button" class="btn btn-primary" disabled>Comprar (demo)</button></div>
</div></div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script><script src="assets/js/catalog.js"></script>
</body></html>
