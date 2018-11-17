<?php

namespace App\Repository;

use App\Entity\PriceDiscounts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PriceDiscounts|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceDiscounts|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceDiscounts[]    findAll()
 * @method PriceDiscounts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceDiscountsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PriceDiscounts::class);
    }

    // /**
    //  * @return PriceDiscounts[] Returns an array of PriceDiscounts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PriceDiscounts
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
