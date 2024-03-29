<?php

namespace App\Repository;

use App\Entity\Motcles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Motcles>
 *
 * @method Motcles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Motcles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Motcles[]    findAll()
 * @method Motcles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotclesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Motcles::class);
    }

//    /**
//     * @return Motcles[] Returns an array of Motcles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Motcles
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
