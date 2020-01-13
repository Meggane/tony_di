<?php

namespace App\Repository;

use App\Entity\PostOneManShow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PostOneManShow|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostOneManShow|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostOneManShow[]    findAll()
 * @method PostOneManShow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostOneManShowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostOneManShow::class);
    }

    // /**
    //  * @return PostOneManShow[] Returns an array of PostOneManShow objects
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
    public function findOneBySomeField($value): ?PostOneManShow
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
