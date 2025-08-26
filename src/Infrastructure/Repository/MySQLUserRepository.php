<?php
namespace App\Infrastructure\Repository;
use App\Domain\Repository\UserRepositoryInterface; use App\Domain\Entity\User; use PDO;
class MySQLUserRepository implements UserRepositoryInterface {
  public function __construct(private PDO $pdo) {}
  public function findByEmail(string $email): ?User {
    $stmt=$this->pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1'); $stmt->execute([':email'=>$email]);
    $row=$stmt->fetch(); if(!$row) return null;
    $u=new User(); $u->id=(int)$row['id']; $u->name=$row['name']; $u->email=$row['email']; $u->password_hash=$row['password_hash']; $u->role=$row['role']; return $u;
  }
  public function existsByEmail(string $email): bool {
    $stmt=$this->pdo->prepare('SELECT 1 FROM users WHERE email = :email LIMIT 1'); $stmt->execute([':email'=>$email]); return (bool)$stmt->fetchColumn();
  }
  public function create(User $user): int {
    $stmt=$this->pdo->prepare('INSERT INTO users (name,email,password_hash,role) VALUES (:name,:email,:hash,:role)');
    $stmt->execute([':name'=>$user->name, ':email'=>$user->email, ':hash'=>$user->password_hash, ':role'=>$user->role]);
    return (int)$this->pdo->lastInsertId();
  }
}
