<?php

namespace App\Repository;

use App\Entity\UserLivraison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserLivraison|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserLivraison|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserLivraison[]    findAll()
 * @method UserLivraison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserLivraisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserLivraison::class);
    }

    public function findAdresses($user_id)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.user_id = :val')
            ->setParameter('val', $user_id)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return UserLivraison[] Returns an array of UserLivraison objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserLivraison
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
