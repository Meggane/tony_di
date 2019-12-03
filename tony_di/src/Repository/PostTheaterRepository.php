<?php

namespace App\Repository;

use App\Entity\PostTheater;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PostTheater|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostTheater|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostTheater[]    findAll()
 * @method PostTheater[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostTheaterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostTheater::class);
    }

    // /**
    //  * @return PostTheater[] Returns an array of PostTheater objects
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
    public function findOneBySomeField($value): ?PostTheater
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
