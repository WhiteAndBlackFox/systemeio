<?php

namespace App\Entity\Enum;

enum OrderStatus
{
    public const STATUS_CREATED = 0;

    public const STATUS_PAID = 1;

    public const STATUS_CANCELED = 2;

    public const STATUS_COMPLETED = 3;
}
