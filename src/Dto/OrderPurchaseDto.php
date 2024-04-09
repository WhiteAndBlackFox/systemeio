<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class OrderPurchaseDto
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly ?int $order,
        #[Assert\NotBlank]
        public readonly ?string $paymentProcessor,
    ) {
    }
}
