<?php

namespace App\Repository;

use App\Entity\RequeteHTTP;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RequeteHTTP|null find($id, $lockMode = null, $lockVersion = null)
 * @method RequeteHTTP|null findOneBy(array $criteria, array $orderBy = null)
 * @method RequeteHTTP[]    findAll()
 * @method RequeteHTTP[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequeteHTTPRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RequeteHTTP::class);
    }

    // /**
    //  * @return RequeteHTTP[] Returns an array of RequeteHTTP objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RequeteHTTP
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
