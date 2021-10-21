<?php

declare(strict_types = 1);

/**
 * Вспомогательный класс для класса ProductPage.
 */
class Product
{
    private $id, $title, $description, $image, $price;

    public function __construct(
        string $id,
        string $title,
        string $description,
        string $image,
        float $price
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
    }

    public function getId(): string { return $this->id; }

    public function getTitle(): string { return $this->title; }

    public function getDescription(): string { return $this->description; }

    public function getImage(): string { return $this->image; }

    public function getPrice(): float { return $this->price; }
}

function viewHtmlSimplePage(string $title, string $text) {
    echo "HTML view of a simple content page:
<html><body>
<h1>$title</h1>
<div class='text'>$text</div>
</body></html>
";
}

function viewJsonSimplePage(string $title, string $text) {
    echo json_encode([
        'title' => $title,
        'text' => $text,
    ], JSON_PRETTY_PRINT);
}

function viewHtmlProductPage(Product $product) {
    echo "<html><body>
<h1>{$product->getTitle()}</h1>
<div class='text'>{$product->getDescription()}</div>
<img src='{$product->getImage()}'>
<a href='/cart/add/{$product->getId()}'>Add to cart</a>
</body></html>
";
}

function viewJsonProductPage(Product $product) {
    echo json_encode([
        'title' => $product->getTitle(),
        'text' => $product->getDescription(),
        'img' => $product->getImage(),
        'link' => [
            'href' => "/cart/add/" . $product->getId(),
            'title' => $product->getTitle()
        ],
    ], JSON_PRETTY_PRINT);
}

viewHtmlSimplePage("Home", "Welcome to our website!");
echo "\n\n";
viewJsonSimplePage("Home", "Welcome to our website!");
echo "\n\n";


$product = new Product("123", "Star Wars, episode1",
    "A long time ago in a galaxy far, far away...",
    "/images/star-wars.jpeg", 39.95);

viewHtmlProductPage($product);
echo "\n\n";
viewJsonProductPage($product);
echo "\n\n";

