<?php

namespace App\Repository;

use App\Entity\ParametreHTTP;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParametreHTTP|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParametreHTTP|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParametreHTTP[]    findAll()
 * @method ParametreHTTP[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParametreHTTPRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParametreHTTP::class);
    }

    // /**
    //  * @return ParametreHTTP[] Returns an array of ParametreHTTP objects
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
    public function findOneBySomeField($value): ?ParametreHTTP
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
