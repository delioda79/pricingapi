<?php

namespace App\Repository;

use App\Entity\Amounts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Amounts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Amounts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Amounts[]    findAll()
 * @method Amounts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AmountsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Amounts::class);
    }

    // /**
    //  * @return Amounts[] Returns an array of Amounts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Amounts
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
