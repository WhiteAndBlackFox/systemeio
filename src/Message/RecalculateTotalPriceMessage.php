<?php

namespace App\Message;

final class RecalculateTotalPriceMessage
{
    /*
     * Add whatever properties and methods you need
     * to hold the data for this message class.
     */

    public function __construct(
        private readonly int $orderId,
    ) {
    }

    public function getOrderId() : int
    {
        return $this->orderId;
    }
}
