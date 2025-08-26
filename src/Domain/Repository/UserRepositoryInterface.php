<?php
namespace App\Domain\Repository;
use App\Domain\Entity\User;
interface UserRepositoryInterface {
  public function findByEmail(string $email): ?User;
  public function existsByEmail(string $email): bool;
  public function create(User $user): int;
}
