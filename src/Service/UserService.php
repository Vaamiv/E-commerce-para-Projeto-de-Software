<?php
namespace App\Service;
use App\Domain\Repository\UserRepositoryInterface; use App\Domain\Entity\User;
class UserService {
  public function __construct(private UserRepositoryInterface $users, private PasswordHasherInterface $hasher) {}
  public function register(string $name, string $email, string $password, string $role='ADMIN'): int {
    $name=trim($name); $email=strtolower(trim($email));
    if(!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password)<6) throw new \InvalidArgumentException('Dados inválidos.');
    if($this->users->existsByEmail($email)) throw new \RuntimeException('E-mail já cadastrado.');
    $u=new User(); $u->name=$name; $u->email=$email; $u->password_hash=$this->hasher->hash($password); $u->role=$role?:'ADMIN';
    return $this->users->create($u);
  }
}
