<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderProductRepository;

#[ORM\Entity(repositoryClass: OrderProductRepository::class)]
class OrderProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $order = null;

    #[ORM\ManyToOne(inversedBy: 'orderProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $pricePerOne = null;

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getOrder() : ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order) : static
    {
        $this->order = $order;

        return $this;
    }

    public function getProduct() : ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product) : static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity() : ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity) : static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPricePerOne() : ?string
    {
        return $this->pricePerOne;
    }

    public function setPricePerOne(string $pricePerOne) : static
    {
        $this->pricePerOne = $pricePerOne;

        return $this;
    }
}
