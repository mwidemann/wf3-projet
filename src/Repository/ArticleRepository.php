<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function findTopPlat()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.top = 1')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function CatPlats()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.cat1 = plats')
            ->groupBy('a.cat2')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function CatMenus()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.cat1 = menus')
            ->groupBy('a.cat2')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function CatAccompagnements()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.cat1 = accompagnements')
            ->groupBy('a.cat2')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function CatBoissons()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.cat1 = boissons')
            ->groupBy('a.cat2')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function CatDesserts()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.cat1 = desserts')
            ->groupBy('a.cat2')
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
