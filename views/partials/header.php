<?php $user=$_SESSION['user']??null; ?><!doctype html><html lang="pt-br"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($title ?? 'Commerce Module') ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body><nav class="navbar navbar-expand-lg bg-dark navbar-dark mb-3"><div class="container">
<?php $prefix=(str_contains($_SERVER['PHP_SELF'],'/products/'))?'../':'./'; ?>
<a class="navbar-brand" href="<?= $prefix ?>dashboard.php">Commerce Module</a>
<div class="ms-auto"><?php if($user): ?><span class="navbar-text me-3"><?= htmlspecialchars($user['email']) ?></span><a class="btn btn-outline-light btn-sm" href="<?= $prefix ?>logout.php">Sair</a><?php endif; ?></div>
</div></nav><div class="container pb-4">
