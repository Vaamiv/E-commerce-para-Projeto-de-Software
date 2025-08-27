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
```plantuml
@startuml
class User
class Product
interface UserRepositoryInterface
interface ProductRepositoryInterface
UserRepositoryInterface <|.. MySQLUserRepository
ProductRepositoryInterface <|.. MySQLProductRepository
AuthService ..> UserRepositoryInterface
@enduml
```

### 🔹 Diagrama ER (Persistência)
Estrutura de banco relacional focada no escopo do módulo.
```plantuml
@startuml
entity "users" {
  *id : INT <<PK, AI>>
  --
  name : VARCHAR(120)
  email : VARCHAR(150) <<UNIQUE>>
  password_hash : VARCHAR(255)
  role : VARCHAR(20)
  created_at : TIMESTAMP
}
entity "products" {
  *id : INT <<PK, AI>>
  --
  name : VARCHAR(200)
  price : DECIMAL(10,2)
  description : TEXT
  image_url : VARCHAR(255)
  rating_avg : DECIMAL(3,1)
  rating_count : INT
  created_at : TIMESTAMP
  updated_at : TIMESTAMP
}
@enduml
```

### 🔹 Diagrama de Casos de Uso
Atores: **Admin**, **Staff**, **Visitante/Cliente**.  
Admin: login, CRUD, cadastrar usuários, logout.  
Staff: login, CRUD, logout.  
Visitante: navegar catálogo, buscar produto, ver detalhes.
```plantuml
@startuml
actor Admin
actor Staff
actor "Visitante/Cliente" as Cliente
usecase "Login" as UC1
usecase "CRUD Produtos" as UC2
usecase "Cadastrar Usuário" as UC3
usecase "Logout" as UC4
usecase "Navegar Catálogo" as UC5
usecase "Buscar Produto" as UC6
usecase "Ver Detalhes" as UC7
Admin --> UC1
Admin --> UC2
Admin --> UC3
Admin --> UC4
Staff --> UC1
Staff --> UC2
Staff --> UC4
Cliente --> UC5
Cliente --> UC6
Cliente --> UC7
@enduml
```

### 🔹 Diagrama de Sequência (Fluxo: Admin cadastra produto)
Mostra interação entre Admin, UI, Service, Repositório e Banco.
```plantuml
@startuml
actor Admin
participant "UI (create.php)" as UI
participant ProductService as Svc
participant ProductRepositoryInterface as RepoI
participant MySQLProductRepository as Repo
database "DB/PDO" as DB
Admin -> UI : abrir tela criação
UI -> Svc : submit(form)
Svc -> RepoI : create(produto)
RepoI -> Repo : chamada concreta
Repo -> DB : INSERT INTO products
DB --> Repo : id gerado
Repo --> Svc : id
Svc --> UI : sucesso
UI --> Admin : redirect p/ lista
@enduml
```

---

## 📹 Sugestão de Apresentação
- **1 min:** Interface (login, dashboard, CRUD, catálogo).  
- **1 min:** Diagramas ER + Classes.  
- **2 min:** Código e padrões aplicados (Database Singleton, Strategy de senha, Container DI, DIP).  
- **1 min:** Considerações finais, melhorias futuras.

---

## 📂 Estrutura Recomendada
```
commerce-module/
 ├── public/         # arquivos acessados pelo navegador (index.php, login.php, etc.)
 ├── src/            # classes (Domain, Service, Repository, Config, Http)
 ├── database/       # schema.sql e seed.sql
 ├── docs/           # diagramas PlantUML e imagens exportadas
 └── README.md
```

---

## ✅ Status
✔️ Login funcional  
✔️ CRUD de produtos  
✔️ Catálogo público  
✔️ Cadastro de usuários (somente Admin)  
✔️ Modelagem UML concluída (Classes, ER, Casos de Uso, Sequência)  

---
