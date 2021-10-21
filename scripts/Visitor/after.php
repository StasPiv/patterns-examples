<?php

declare(strict_types = 1);

// @see https://ru.wikipedia.org/wiki/%D0%9F%D0%BE%D1%81%D0%B5%D1%82%D0%B8%D1%82%D0%B5%D0%BB%D1%8C_(%D1%88%D0%B0%D0%B1%D0%BB%D0%BE%D0%BD_%D0%BF%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F)

class Product implements Acceptable
{
    use AcceptableTrait;

    private $price;

    private $title;

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }
}

class Category implements Acceptable
{
    use AcceptableTrait;

    private $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }
}

trait AcceptableTrait
{
    public function accept(Visitor $visitor)
    {
        if (!$this instanceof Acceptable) {
            throw new RuntimeException('You must use trait only in acceptable classes');
        }

        return $visitor->visit($this);
    }
}

interface Acceptable
{
    public function accept(Visitor $visitor);
}

interface Visitor
{
    public function visit(Acceptable $node);
}

class SalesPriceVisitor implements Visitor
{
    public function visit(Acceptable $node)
    {
        if ($node instanceof Product) {
            $node->setPrice($node->getPrice() * 0.95);
        } elseif ($node instanceof Category) {
            $node->setTitle('This category for sale');
        }
    }
}

class SalesTitleVisitor implements Visitor
{
    public function visit(Acceptable $node)
    {
        if ($node instanceof Product) {
            $node->setTitle($node->getTitle() . ' ' . ' (FOR SALE)');
        } elseif ($node instanceof Category) {
            $node->setTitle('This category for sale');
        }
    }
}

$product = new Product();
$product->setPrice(20);
$product->setTitle('New product');

$category = new Category();
$category->setTitle('New category');

$priceVisitor = new SalesPriceVisitor();
$titleVisitor = new SalesTitleVisitor();

echo sprintf('Category: %s. Old title: %s. Old price: %d', $category->getTitle(), $product->getTitle(), $product->getPrice()) . PHP_EOL;

$product->accept($priceVisitor);
$product->accept($titleVisitor);
$category->accept($priceVisitor);

echo sprintf('Category: %s. New title: %s. New price: %d', $category->getTitle(), $product->getTitle(), $product->getPrice()) . PHP_EOL;