<?php

namespace App\Controller;

use App\Entity\Order;
use App\Dto\OrderAddDto;
use App\Entity\OrderProduct;
use App\Utils\PriceCalculator;
use App\Entity\Enum\OrderStatus;
use Doctrine\ORM\EntityManagerInterface;
use App\Message\RecalculateTotalPriceMessage;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/order', name: 'api_')]
class OrderController extends AbstractController
{
    public function __construct(private PriceCalculator $priceCalculator)
    {
    }

    #[Route('/add', name: 'app_order', methods: ['POST'])]
    public function add(
        #[MapRequestPayload]
        OrderAddDto $orderAddDto,
        EntityManagerInterface $em,
        MessageBusInterface $bus
    ) : JsonResponse {
        $price = $this->priceCalculator
            ->setEntityManagerInterface($em)
            ->calculatePrice($orderAddDto);

        if (empty($price)) {
            throw $this->createNotFoundException();
        }

        $user = $this->getUser();
        $order = $em->getRepository(Order::class)->getCreatedOrderByUserId($user?->getId());
        if (empty($order)) {
            $order = new Order();
            $order->setOrderDate(new \DateTimeImmutable('now'));
            $order->setStatusId(OrderStatus::STATUS_CREATED);
            $order->setTotalPrice(0.0);
            $order->setDeleted(false);
            $order->setOwner($user);
            $em->persist($order);
        }

        $orderProduct = new OrderProduct();
        $orderProduct->setOrder($order);
        $orderProduct->setProduct($this->priceCalculator->getProduct());
        $orderProduct->setQuantity($orderAddDto->quantity);
        $orderProduct->setPricePerOne($price);
        $em->persist($orderProduct);
        $em->flush();

        $bus->dispatch(new RecalculateTotalPriceMessage($order->getId()));

        return new JsonResponse([
            'message' => 'Product added to order',
        ]);
    }
}
