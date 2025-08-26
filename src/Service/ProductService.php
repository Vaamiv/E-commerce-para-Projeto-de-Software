<?php
namespace App\Service;
use App\Domain\Repository\ProductRepositoryInterface; use App\Domain\Entity\Product;
class ProductService {
  public function __construct(private ProductRepositoryInterface $repo) {}
  /** @return Product[] */ public function list(): array { return $this->repo->all(); }
  public function get(int $id): ?Product { return $this->repo->find($id); }
  public function create(string $name, float $price, ?string $description, ?string $image_url, ?float $rating_avg, ?int $rating_count): int {
    $p=new Product(); $p->name=$name; $p->price=$price; $p->description=$description; $p->image_url=$image_url; $p->rating_avg=$rating_avg; $p->rating_count=$rating_count; return $this->repo->create($p);
  }
  public function update(int $id, string $name, float $price, ?string $description, ?string $image_url, ?float $rating_avg, ?int $rating_count): bool {
    $p=new Product(); $p->id=$id; $p->name=$name; $p->price=$price; $p->description=$description; $p->image_url=$image_url; $p->rating_avg=$rating_avg; $p->rating_count=$rating_count; return $this->repo->update($p);
  }
  public function delete(int $id): bool { return $this->repo->delete($id); }
}
