<?php /** @var array $data */ $editing=!empty($data['id']); $img=$data['image_url'] ?? ''; ?>
<form method="post" class="vstack gap-3">
  <?= App\Security\Csrf::input() ?>
  <div><label class="form-label">Nome</label><input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($data['name'] ?? '') ?>"></div>
  <div class="row g-3">
    <div class="col-md-6"><label class="form-label">Preço (R$)</label><input type="number" step="0.01" name="price" class="form-control" required value="<?= htmlspecialchars($data['price'] ?? '') ?>"></div>
    <div class="col-md-3"><label class="form-label">Nota média (0-5)</label><input type="number" step="0.1" min="0" max="5" name="rating_avg" class="form-control" value="<?= htmlspecialchars($data['rating_avg'] ?? '') ?>"></div>
    <div class="col-md-3"><label class="form-label">Qtd. avaliações</label><input type="number" min="0" name="rating_count" class="form-control" value="<?= htmlspecialchars($data['rating_count'] ?? '') ?>"></div>
  </div>
  <div><label class="form-label">Descrição</label><textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($data['description'] ?? '') ?></textarea></div>
  <div class="row g-3 align-items-end">
    <div class="col-md-9">
      <label class="form-label">URL da Imagem</label>
      <input type="text" name="image_url" class="form-control" placeholder="/assets/img/camiseta_fortnite.jpg" value="<?= htmlspecialchars($img) ?>">
      <div class="form-text">Use caminho relativo (ex.: <code>/assets/img/camiseta_fortnite.jpg</code>) ou URL absoluta.</div>
    </div>
    <div class="col-md-3 text-center">
      <div class="border rounded p-2 bg-light">
        <div class="small text-muted">Preview</div>
        <?php if ($img): ?><img id="imgPreview" src="<?= htmlspecialchars($img) ?>" style="width:100%;height:120px;object-fit:cover;border-radius:6px;"><?php else: ?><div id="imgPreviewBox" style="width:100%;height:120px;border-radius:6px;background:#e9ecef;"></div><?php endif; ?>
      </div>
    </div>
  </div>
  <div class="d-flex gap-2"><a class="btn btn-outline-secondary" href="index.php">Cancelar</a><button class="btn btn-primary"><?= $editing ? 'Salvar alterações' : 'Criar produto' ?></button></div>
</form>
<script>
document.addEventListener('input', function(e){
  if(e.target && e.target.name === 'image_url'){
    const val=e.target.value.trim(); const img=document.getElementById('imgPreview'); const box=document.getElementById('imgPreviewBox');
    if(img){ img.src = val || ''; } if(box){ box.style.backgroundImage = val ? 'url('+val+')' : 'none'; box.style.backgroundSize='cover'; }
  }
});
</script>
