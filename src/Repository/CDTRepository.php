<?php

namespace App\Repository;

use App\Entity\CDT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CDT|null find($id, $lockMode = null, $lockVersion = null)
 * @method CDT|null findOneBy(array $criteria, array $orderBy = null)
 * @method CDT[]    findAll()
 * @method CDT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CDTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CDT::class);
    }

    // /**
    //  * @return CDT[] Returns an array of CDT objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CDT
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
