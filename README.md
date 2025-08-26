# Commerce Module — Loja de Roupas Gamer (PHP + MySQL)
Login + CRUD + Catálogo (cards, modal, busca) e **Cadastro de Usuários** (apenas ADMIN), com links relativos para `http://localhost/commerce-module/public/`.

## Como rodar
1. Copie `commerce-module` para `C:/xampp/htdocs/`.
2. phpMyAdmin → selecione seu banco (ex.: `commerce`) → **Importar**:
   - `database/schema.sql`
   - `database/seed.sql`
3. Ajuste `src/Config/env.php` (nome do banco, usuário, senha).
4. Acesse:
   - Admin: `http://localhost/commerce-module/public/login.php` (admin@example.com / admin123)
   - Catálogo: `http://localhost/commerce-module/public/catalog.php`
5. Cadastro de usuários: Dashboard → **Usuários → Cadastrar usuário** (somente ADMIN).

## Imagens
Coloque as imagens em `public/assets/img/` e use no CRUD o caminho relativo (ex.: `/commerce-module/public/assets/img/headset.png`).

## Arquitetura
- Camadas: Entity, Repository, Service, Http/Container (DIP).
- Padrões: Singleton (Database), Strategy (PasswordHasher), Factory/DI (Container).
- Segurança: CSRF, hash de senha, sessões.
