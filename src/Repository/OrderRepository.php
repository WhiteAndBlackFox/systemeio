<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\Enum\OrderStatus;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function getCreatedOrderByUserId(?int $userId) : ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.owner = :user')
            ->andWhere('o.status_id = :status')
            ->andWhere('o.isDeleted = false')
            ->setParameter('user', $userId)
            ->setParameter('status', OrderStatus::STATUS_CREATED)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function updateTotalPrice(float $totalPrice, int $orderId) : void
    {
        $this->createQueryBuilder('o')->update()
            ->set('o.totalPrice', ':totalPrice')
            ->where('o.id', ':orderId')
            ->setParameter('totalPrice', $totalPrice)
            ->setParameter('orderId', $orderId)
            ->getQuery()
            ->execute();
    }

    //    /**
    //     * @return Order[] Returns an array of Order objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Order
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
