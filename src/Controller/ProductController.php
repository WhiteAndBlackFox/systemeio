<?php

namespace App\Controller;

use App\Dto\CalculatePriceDto;
use App\Utils\PriceCalculator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api', name: 'api_')]
class ProductController extends AbstractController
{
    #[Route('/calculate-price', name: 'app_calculate_price')]
    public function calculatePrice(
        #[MapRequestPayload]
        CalculatePriceDto $calculatePriceDto,
        EntityManagerInterface $em
    ) : JsonResponse {
        $priceCalculator = new PriceCalculator($em);

        return new JsonResponse([
            'price' => $priceCalculator->calculatePrice($calculatePriceDto),
        ]);
    }
}
