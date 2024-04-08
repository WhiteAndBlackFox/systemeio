<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CalculatePriceDto
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly ?int $product,
        #[Assert\NotBlank]
        public readonly ?string $taxNumber,
        #[Assert\NotBlank]
        public readonly ?string $couponCode,
    ) {
    }
}
