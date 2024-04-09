<?php

namespace App\Utils;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\TaxRate;
use App\Dto\CalculatePriceDto;
use App\Entity\Enum\CouponType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class PriceCalculator
{
    public function __construct(private ?EntityManagerInterface $em)
    {
    }

    public function calculatePrice(CalculatePriceDto $calculatePriceDto) : float
    {
        $product = $this->em->getRepository(Product::class)
            ->findOneBy(['id' => $calculatePriceDto->product]);

        if (empty($product)) {
            throw new NotFoundHttpException();
        }

        $price = $product->getPrice();

        $countryCode = substr($calculatePriceDto->taxNumber, 0, 2);

        $taxRate = $this->em->getRepository(TaxRate::class)
            ->findOneBy(['countryCode' => $countryCode]);

        if (empty($taxRate)) {
            throw new NotFoundHttpException();
        }

        $coupon = $this->em->getRepository(Coupon::class)
            ->findNotExpiredCouponByCode($calculatePriceDto->couponCode);

        $discount = match ($coupon->getType() ?? null) {
            CouponType::TYPE_PERCENT => $price * $coupon->getDiscount() / 100,
            CouponType::TYPE_FIXED => $coupon->getDiscount(),
            default => 0.0,
        };

        $priceDiscount = $price - $discount;

        return $priceDiscount + ($priceDiscount * $taxRate->getRate() / 100);
    }

    public function setEntityManagerInterface(EntityManagerInterface $em) : self
    {
        $this->em = $em;

        return $this;
    }
}
