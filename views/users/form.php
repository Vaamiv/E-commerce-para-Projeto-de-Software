<?php /** @var array $data */ $err=$data['error']??null; $ok=$data['ok']??null; ?>
<form method="post" class="vstack gap-3" autocomplete="off">
  <?= App\Security\Csrf::input() ?>
  <?php if($err): ?><div class="alert alert-danger"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <?php if($ok): ?><div class="alert alert-success"><?= htmlspecialchars($ok) ?></div><?php endif; ?>
  <div><label class="form-label">Nome</label><input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($data['name'] ?? '') ?>"></div>
  <div><label class="form-label">E-mail</label><input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($data['email'] ?? '') ?>"></div>
  <div class="row g-3">
    <div class="col-md-6"><label class="form-label">Senha</label><input type="password" name="password" class="form-control" required minlength="6"></div>
    <div class="col-md-6"><label class="form-label">Confirmar Senha</label><input type="password" name="password2" class="form-control" required minlength="6"></div>
  </div>
  <div><label class="form-label">Papel</label>
    <select name="role" class="form-select">
      <option value="ADMIN" <?= (($data['role'] ?? '')==='ADMIN') ? 'selected' : '' ?>>ADMIN</option>
      <option value="STAFF" <?= (($data['role'] ?? '')==='STAFF') ? 'selected' : '' ?>>STAFF</option>
    </select>
  </div>
  <div class="d-flex gap-2"><a class="btn btn-outline-secondary" href="../dashboard.php">Voltar</a><button class="btn btn-primary">Cadastrar usuário</button></div>
</form>
