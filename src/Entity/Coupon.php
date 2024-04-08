<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CouponRepository;

#[ORM\Entity(repositoryClass: CouponRepository::class)]
class Coupon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column]
    private ?int $discount = null;

    #[ORM\Column]
    private ?bool $type = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $validFrom = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $validTo = null;

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getCode() : ?string
    {
        return $this->code;
    }

    public function setCode(string $code) : static
    {
        $this->code = $code;

        return $this;
    }

    public function getDiscount() : ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount) : static
    {
        $this->discount = $discount;

        return $this;
    }

    public function getType() : ?int
    {
        return $this->type;
    }

    public function setType(bool $type) : static
    {
        $this->type = $type;

        return $this;
    }

    public function getValidFrom() : ?\DateTimeImmutable
    {
        return $this->validFrom;
    }

    public function setValidFrom(\DateTimeImmutable $validFrom) : static
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    public function getValidTo() : ?\DateTimeImmutable
    {
        return $this->validTo;
    }

    public function setValidTo(\DateTimeImmutable $validTo) : static
    {
        $this->validTo = $validTo;

        return $this;
    }
}
