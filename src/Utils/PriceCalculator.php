<?php

namespace App\Utils;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\TaxRate;
use App\Entity\Enum\CouponType;
use App\Dto\CalculateProductDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class PriceCalculator
{
    private ?Product $product;

    public function __construct(private ?EntityManagerInterface $em)
    {
    }

    public function calculatePrice(CalculateProductDto $calculateProductDto) : float
    {
        $this->product = $this->em->getRepository(Product::class)
            ->findOneBy(['id' => $calculateProductDto->product]);

        if (empty($this->product)) {
            throw new NotFoundHttpException();
        }

        $price = $this->product->getPrice();

        $countryCode = substr($calculateProductDto->taxNumber, 0, 2);

        $taxRate = $this->em->getRepository(TaxRate::class)
            ->findOneBy(['countryCode' => $countryCode]);

        if (empty($taxRate)) {
            throw new NotFoundHttpException();
        }

        $coupon = $this->em->getRepository(Coupon::class)
            ->findNotExpiredCouponByCode($calculateProductDto->couponCode);

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

    public function getProduct() : Product
    {
        return $this->product;
    }
}
