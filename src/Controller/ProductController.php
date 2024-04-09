<?php

namespace App\Controller;

use App\Dto\CalculatePriceDto;
use App\Utils\PriceCalculator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/product', name: 'api_')]
class ProductController extends AbstractController
{
    public function __construct(private PriceCalculator $priceCalculator)
    {
    }

    #[Route('/calculate-price', name: 'app_calculate_price')]
    public function calculatePrice(
        #[MapRequestPayload]
        CalculatePriceDto $calculatePriceDto,
        EntityManagerInterface $em
    ) : JsonResponse {
        return new JsonResponse([
            'price' => $this->priceCalculator
                ->setEntityManagerInterface($em)
                ->calculatePrice($calculatePriceDto),
        ]);
    }
}
