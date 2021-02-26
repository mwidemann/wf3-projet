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
    
    public function catPlats()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.cat1 = :val')
            ->setParameter('val', "plats")
            ->groupBy('a.cat2')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function catMenus()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.cat1 = :val')
            ->setParameter('val', "menus")
            ->groupBy('a.cat2')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function catAccompagnements()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.cat1 = :val')
            ->setParameter('val', "accompagnements")
            ->groupBy('a.cat2')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function catBoissons()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.cat1 = :val')
            ->setParameter('val', "boissons")
            ->groupBy('a.cat2')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    
    public function catDesserts()
    {
        return $this->createQueryBuilder('a')
        ->andWhere('a.cat1 = :val')
        ->setParameter('val', "desserts")
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
