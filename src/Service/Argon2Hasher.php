<?php
namespace App\Service;
class Argon2Hasher implements PasswordHasherInterface {
  public function hash(string $plain): string { return password_hash($plain, PASSWORD_ARGON2ID); }
  public function verify(string $plain, string $hash): bool { return password_verify($plain, $hash); }
}
