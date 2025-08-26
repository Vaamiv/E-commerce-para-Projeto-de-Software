<?php
namespace App\Infrastructure\Repository;
use App\Domain\Repository\ProductRepositoryInterface; use App\Domain\Entity\Product; use PDO;
class MySQLProductRepository implements ProductRepositoryInterface {
  public function __construct(private PDO $pdo) {}
  public function all(): array { $rows=$this->pdo->query('SELECT * FROM products ORDER BY id DESC')->fetchAll(); return array_map([$this,'map'],$rows); }
  public function find(int $id): ?Product { $s=$this->pdo->prepare('SELECT * FROM products WHERE id=:id'); $s->execute([':id'=>$id]); $r=$s->fetch(); return $r?$this->map($r):null; }
  public function create(Product $p): int {
    $s=$this->pdo->prepare('INSERT INTO products (name,price,description,image_url,rating_avg,rating_count,created_at,updated_at) VALUES (:name,:price,:description,:image_url,:rating_avg,:rating_count,NOW(),NOW())');
    $s->execute([':name'=>$p->name,':price'=>$p->price,':description'=>$p->description,':image_url'=>$p->image_url,':rating_avg'=>$p->rating_avg,':rating_count'=>$p->rating_count]);
    return (int)$this->pdo->lastInsertId();
  }
  public function update(Product $p): bool {
    $s=$this->pdo->prepare('UPDATE products SET name=:name,price=:price,description=:description,image_url=:image_url,rating_avg=:rating_avg,rating_count=:rating_count,updated_at=NOW() WHERE id=:id');
    return $s->execute([':id'=>$p->id,':name'=>$p->name,':price'=>$p->price,':description'=>$p->description,':image_url'=>$p->image_url,':rating_avg'=>$p->rating_avg,':rating_count'=>$p->rating_count]);
  }
  public function delete(int $id): bool { $s=$this->pdo->prepare('DELETE FROM products WHERE id=:id'); return $s->execute([':id'=>$id]); }
  private function map(array $row): Product {
    $p=new Product(); $p->id=(int)$row['id']; $p->name=$row['name']; $p->price=(float)$row['price'];
    $p->description=$row['description']??null; $p->image_url=$row['image_url']??null;
    $p->rating_avg=isset($row['rating_avg'])?(float)$row['rating_avg']:null; $p->rating_count=isset($row['rating_count'])?(int)$row['rating_count']:null;
    $p->created_at=$row['created_at']??null; $p->updated_at=$row['updated_at']??null; return $p;
  }
}
