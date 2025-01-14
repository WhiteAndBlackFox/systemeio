<?php

namespace App\Repository;

use App\Entity\TaxRate;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<TaxRate>
 *
 * @method TaxRate|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaxRate|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaxRate[]    findAll()
 * @method TaxRate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxRateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaxRate::class);
    }

    //    /**
    //     * @return TaxRate[] Returns an array of TaxRate objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TaxRate
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
