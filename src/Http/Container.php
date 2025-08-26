<?php
namespace App\Http;
use App\Config\Database;
use App\Infrastructure\Repository\MySQLUserRepository;
use App\Infrastructure\Repository\MySQLProductRepository;
use App\Service\AuthService;
use App\Service\ProductService;
use App\Service\UserService;
use App\Service\BcryptHasher;
use App\Service\Argon2Hasher;
use App\Service\PasswordHasherInterface;
use PDO;

class Container {
  private ?PDO $pdo=null; private ?PasswordHasherInterface $hasher=null;
  public function pdo(): PDO { if(!$this->pdo) $this->pdo=Database::getConnection(); return $this->pdo; }
  public function userRepository(): MySQLUserRepository { return new MySQLUserRepository($this->pdo()); }
  public function productRepository(): MySQLProductRepository { return new MySQLProductRepository($this->pdo()); }
  public function passwordHasher(): PasswordHasherInterface {
    if($this->hasher) return $this->hasher;
    $config = require __DIR__.'/../Config/env.php'; $algo = $config['security']['password_hasher'] ?? 'bcrypt';
    $this->hasher = ($algo==='argon2') ? new Argon2Hasher() : new BcryptHasher(); return $this->hasher;
  }
  public function authService(): AuthService { return new AuthService($this->userRepository(), $this->passwordHasher()); }
  public function productService(): ProductService { return new ProductService($this->productRepository()); }
  public function userService(): UserService { return new UserService($this->userRepository(), $this->passwordHasher()); }
}
