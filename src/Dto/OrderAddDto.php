<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class OrderAddDto extends CalculateProductDto
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly ?int $product,
        #[Assert\NotBlank]
        public readonly ?string $taxNumber,
        #[Assert\NotBlank]
        public readonly ?string $couponCode,
        #[Assert\NotBlank]
        #[Assert\GreaterThan(0)]
        public readonly ?int $quantity,
    ) {
    }
}
