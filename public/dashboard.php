<?php require __DIR__.'/bootstrap.php'; require_login(); $user=$_SESSION['user']; ?>
<!doctype html><html lang="pt-br"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard - Commerce Module</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body><nav class="navbar navbar-expand-lg bg-dark navbar-dark"><div class="container">
<a class="navbar-brand" href="dashboard.php">Commerce Module</a>
<div class="ms-auto"><span class="navbar-text me-3">Olá, <?= htmlspecialchars($user['name']) ?></span><a class="btn btn-outline-light btn-sm" href="logout.php">Sair</a></div>
</div></nav>
<div class="container py-4"><div class="row g-3">
<div class="col-12"><?php if($m=flash()): ?><div class="alert alert-success"><?= htmlspecialchars($m) ?></div><?php endif; ?></div>
<div class="col-12 col-md-6"><div class="card shadow-sm"><div class="card-body">
<h2 class="h5">Produtos</h2><p>Gerencie o catálogo de produtos (CRUD completo).</p><a class="btn btn-primary" href="products/index.php">Abrir</a>
</div></div></div>
<div class="col-12 col-md-6"><div class="card shadow-sm"><div class="card-body">
<h2 class="h5">Catálogo Público</h2><p>Visualize como os clientes veem os produtos.</p><a class="btn btn-outline-secondary" href="catalog.php" target="_blank">Abrir catálogo</a>
</div></div></div>
<div class="col-12 col-md-6"><div class="card shadow-sm"><div class="card-body">
<h2 class="h5">Usuários</h2><p>Cadastrar novos logins para o painel.</p><a class="btn btn-outline-primary" href="users/create.php">Cadastrar usuário</a>
</div></div></div>
</div></div></body></html>
