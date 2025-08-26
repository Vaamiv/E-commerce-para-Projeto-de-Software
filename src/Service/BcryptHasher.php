<?php
namespace App\Service;
class BcryptHasher implements PasswordHasherInterface {
  public function hash(string $plain): string { return password_hash($plain, PASSWORD_BCRYPT); }
  public function verify(string $plain, string $hash): bool { return password_verify($plain, $hash); }
}
