<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TaxRateRepository;

#[ORM\Entity(repositoryClass: TaxRateRepository::class)]
class TaxRate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $rate = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column(length: 255)]
    private ?string $country_code = null;

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(string $name) : static
    {
        $this->name = $name;

        return $this;
    }

    public function getRate() : ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate) : static
    {
        $this->rate = $rate;

        return $this;
    }

    public function isActive() : ?bool
    {
        return $this->isActive;
    }

    public function setActive(bool $isActive) : static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCountryCode() : ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $country_code) : static
    {
        $this->country_code = $country_code;

        return $this;
    }
}
