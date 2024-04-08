<?php

namespace App\Controller;

use App\Entity\Coupon;
use App\Dto\CouponValidateDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Coupon controller.
 */
#[Route('/api', name: 'api_')]
class CouponController extends AbstractController
{
    #[Route('/coupon-validate', name: 'app_coupon_check', methods: ['POST'])]
    public function validate(
        #[MapRequestPayload]
        CouponValidateDto $couponValidateDto,
        EntityManagerInterface $em
    ) : JsonResponse {
        $coupon = $em->getRepository(Coupon::class)
            ->findNotExpiredCouponByCode($couponValidateDto->coupon);

        if (is_null($coupon)) {
            throw $this->createNotFoundException();
        }

        return new JsonResponse(null, 204);
    }
}
