<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column]
    private ?bool $isDeleted = null;

    #[ORM\Column]
    private ?bool $isVerified = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'owner')]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getEmail() : ?string
    {
        return $this->email;
    }

    public function setEmail(string $email) : static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName() : ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name) : static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName() : ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name) : static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getSurname() : ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname) : static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPhone() : ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone) : static
    {
        $this->phone = $phone;

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

    public function isVerified() : ?bool
    {
        return $this->isVerified;
    }

    public function setVerified(bool $isVerified) : static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setOwner($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getOwner() === $this) {
                $order->setOwner(null);
            }
        }

        return $this;
    }
}
