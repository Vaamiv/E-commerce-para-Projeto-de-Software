<?php
namespace App\Service;
use App\Domain\Repository\UserRepositoryInterface; use App\Domain\Entity\User;
class AuthService {
  public function __construct(private UserRepositoryInterface $users, private PasswordHasherInterface $hasher) {}
  public function login(string $email, string $password): ?User {
    $user=$this->users->findByEmail($email); if(!$user) return null;
    return $this->hasher->verify($password, $user->password_hash) ? $user : null;
  }
}
