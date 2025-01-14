<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class CalculatePriceDto extends CalculateProductDto
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
