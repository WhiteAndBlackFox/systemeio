<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $orderDate = null;

    #[ORM\Column]
    private ?int $status_id = null;

    #[ORM\Column]
    private ?float $totalPrice = null;

    #[ORM\Column]
    private ?bool $isDeleted = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    /**
     * @var Collection<int, OrderProduct>
     */
    #[ORM\OneToMany(targetEntity: OrderProduct::class, mappedBy: 'order_id')]
    private Collection $orderProducts;

    public function __construct()
    {
        $this->orderProducts = new ArrayCollection();
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getOrderDate() : ?\DateTimeImmutable
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeImmutable $orderDate) : static
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getStatusId() : ?int
    {
        return $this->status_id;
    }

    public function setStatusId(int $status_id) : static
    {
        $this->status_id = $status_id;

        return $this;
    }

    public function getTotalPrice() : ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice) : static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function isDeleted() : ?bool
    {
        return $this->isDeleted;
    }

    public function setDeleted(bool $isDeleted) : static
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getOwner() : ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner) : static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, OrderProduct>
     */
    public function getOrderProducts() : Collection
    {
        return $this->orderProducts;
    }

    public function addOrderProduct(OrderProduct $orderProduct) : static
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts->add($orderProduct);
            $orderProduct->setOrderId($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct) : static
    {
        if ($this->orderProducts->removeElement($orderProduct)) {
            // set the owning side to null (unless already changed)
            if ($orderProduct->getOrderId() === $this) {
                $orderProduct->setOrderId(null);
            }
        }

        return $this;
    }
}
