<?php

namespace App\Repository;

use App\Entity\HeaderHTTP;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HeaderHTTP|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeaderHTTP|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeaderHTTP[]    findAll()
 * @method HeaderHTTP[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeaderHTTPRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HeaderHTTP::class);
    }

    // /**
    //  * @return HeaderHTTP[] Returns an array of HeaderHTTP objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HeaderHTTP
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
