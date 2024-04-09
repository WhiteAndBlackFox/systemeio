<?php

namespace App\MessageHandler;

use App\Entity\Order;
use App\Entity\OrderProduct;
use Doctrine\ORM\EntityManagerInterface;
use App\Message\RecalculateTotalPriceMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class RecalculateTotalPriceMessageHandler
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function __invoke(RecalculateTotalPriceMessage $message) : void
    {
        $totalPrice = $this->entityManager->getRepository(OrderProduct::class)->getTotalPrice($message->getOrderId());
        $this->entityManager->getRepository(Order::class)->updateTotalPrice($totalPrice, $message->getOrderId());
    }
}
