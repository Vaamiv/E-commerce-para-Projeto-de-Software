<?php
namespace App\Domain\Entity;
class Product {
  public ?int $id=null; public string $name; public float $price;
  public ?string $description=null; public ?string $image_url=null;
  public ?float $rating_avg=null; public ?int $rating_count=null;
  public ?string $created_at=null; public ?string $updated_at=null;
}
