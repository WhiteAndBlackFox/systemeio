<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class CouponValidateDto
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly ?string $coupon
    ) {
    }
}
