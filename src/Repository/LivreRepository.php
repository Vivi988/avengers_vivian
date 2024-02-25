<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livre>
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    /**
     * Trouver les livres dont le titre commence par une lettre spécifique.
     *
     * @param string $lettre La lettre par laquelle le titre doit commencer.
     * @return Livre[] Renvoie un tableau d'objets Livre.
     */
    public function trouverParPremiereLettre($lettre): array
    {
        return $this->createQueryBuilder('l')
            ->where('l.titre LIKE :lettre')
            ->setParameter('lettre', $lettre.'%')
            ->getQuery()
            ->getResult();
    }

    /**
     * Compter le nombre total de livres présents en base.
     *
     * @return int Le nombre total de livres.
     */
    public function compterTousLesLivres(): int
    {
        return $this->createQueryBuilder('l')
            ->select('COUNT(l.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
