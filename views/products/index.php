<?php /** @var array $products */ ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 m-0">Produtos</h1>
  <a class="btn btn-primary" href="create.php">Novo produto</a>
</div>
<table class="table table-striped align-middle">
  <thead><tr><th>#</th><th>Imagem</th><th>Nome</th><th>Preço</th><th>Avaliações</th><th>Descrição</th><th width="160">Ações</th></tr></thead>
  <tbody>
  <?php foreach($products as $p): ?>
    <tr>
      <td><?= (int)$p->id ?></td>
      <td><?php if($p->image_url): ?><img src="<?= htmlspecialchars($p->image_url) ?>" style="width:56px;height:56px;object-fit:cover;border-radius:8px;"><?php else: ?><span class="text-muted">—</span><?php endif; ?></td>
      <td><?= htmlspecialchars($p->name) ?></td>
      <td>R$ <?= number_format($p->price,2,',','.') ?></td>
      <td><?php if($p->rating_avg!==null): ?><?= number_format($p->rating_avg,1,',','.') ?> ⭐ (<?= (int)($p->rating_count ?? 0) ?>)<?php else: ?><span class="text-muted">—</span><?php endif; ?></td>
      <td><?= htmlspecialchars($p->description ?? '') ?></td>
      <td>
        <a class="btn btn-sm btn-secondary" href="edit.php?id=<?= (int)$p->id ?>">Editar</a>
        <a class="btn btn-sm btn-outline-danger" href="delete.php?id=<?= (int)$p->id ?>&csrf=<?= htmlspecialchars(App\Security\Csrf::token()) ?>" onclick="return confirm('Excluir este item?')">Excluir</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
