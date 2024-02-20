<?php

namespace App\Repository;

use App\Entity\LeCailloux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LeCailloux>
 *
 * @method LeCailloux|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeCailloux|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeCailloux[]    findAll()
 * @method LeCailloux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeCaillouxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LeCailloux::class);
    }

//    /**
//     * @return LeCailloux[] Returns an array of LeCailloux objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LeCailloux
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
