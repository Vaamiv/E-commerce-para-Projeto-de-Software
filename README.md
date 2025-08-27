# 📦 Módulo E-commerce (Roupas Gamer)

Este projeto implementa um **módulo funcional de e-commerce** focado em roupas gamer.  
O objetivo principal não é entregar um sistema completo, mas sim **demonstrar a aplicação prática de engenharia de software**: modelagem UML, princípios SOLID, padrões de projeto e persistência de dados em banco relacional.

---

## 🎯 Escopo do Módulo
- **Sistema de Login** (autenticação com hash seguro de senha).
- **CRUD de Produtos** (Create, Read, Update, Delete).
- **Catálogo Público** (cards, busca e modal de detalhes).
- **Cadastro de Usuários** (restrito a Admin).
- Persistência em **MySQL** via PDO.

---

## 🛠️ Tecnologias
- **PHP 8+**
- **MySQL / MariaDB**
- **HTML5 + CSS/Bootstrap**

---

## 🧩 Padrões e Princípios
- **DIP (Dependency Inversion Principle):**  
  Services dependem de interfaces de repositório, não de implementações concretas.
- **Strategy:**  
  Interface `PasswordHasherInterface` com implementações `BcryptHasher` e `Argon2Hasher`.
- **Factory/DI (Injeção de Dependência):**  
  `Container` centraliza criação e injeção de dependências.
- **Singleton:**  
  `Database::getConnection()` garante uma única instância PDO reutilizável.
- **Segurança:**  
  Tokens CSRF em formulários e uso de `password_hash`/`password_verify`.

---

## 📊 Modelagem UML

### 🔹 Diagrama de Classes
Mostra entidades (`User`, `Product`), interfaces de repositório, implementações, serviços, hasher (Strategy), container (Factory/DI) e conexão Singleton.
```![diagrama-classes](https://github.com/user-attachments/assets/149151e0-fe60-4767-beb9-c77986b821e2)

```

### 🔹 Diagrama ER (Persistência)
Estrutura de banco relacional focada no escopo do módulo.
```![diagrama-ER](https://github.com/user-attachments/assets/e1b32a91-0ee0-4bb6-89ad-c4cee84b5fc3)

```

### 🔹 Diagrama de Casos de Uso
Atores: **Admin**, **Staff**, **Visitante/Cliente**.  
Admin: login, CRUD, cadastrar usuários, logout.  
Staff: login, CRUD, logout.  
Visitante: navegar catálogo, buscar produto, ver detalhes.
``![diagrama-casos-de-uso](https://github.com/user-attachments/assets/0f069848-be4a-4cd7-956f-e5a1a6d5435d)

```

### 🔹 Diagrama de Sequência (Fluxo: Admin cadastra produto)
Mostra interação entre Admin, UI, Service, Repositório e Banco.
```![diagrama-de-sequencia](https://github.com/user-attachments/assets/0e5d5125-ce9f-4a37-a6d0-475999eb5948)

```

---


## ✅ Status
✔️ Login funcional  
✔️ CRUD de produtos  
✔️ Catálogo público  
✔️ Cadastro de usuários (somente Admin)  
✔️ Modelagem UML concluída (Classes, ER, Casos de Uso, Sequência)  

---

## Desenvolvido para fins acadêmicos por Thomás Moojen
