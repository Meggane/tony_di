<?php

namespace App\Repository;

use App\Entity\PostDates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PostDates|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostDates|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostDates[]    findAll()
 * @method PostDates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostDatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostDates::class);
    }

    // /**
    //  * @return PostDates[] Returns an array of PostDates objects
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
    public function findOneBySomeField($value): ?PostDates
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
