<?php

namespace App\Repository;

use App\Entity\Flat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Flat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flat[]    findAll()
 * @method Flat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flat::class);
    }

    public function returnFlatsWithActuallyAvailableSlots()
    {
        return $this->createQueryBuilder('f')
            ->select('f.id', 'f.slots', 'orders.reservedSlots')
            ->leftJoin('f.orders', 'orders')
            ->getQuery()
            ->getResult();
    }


    public function returnOneFlatWithActuallyAvailableSlots($value)
    {

            return $this->createQueryBuilder('f')
                ->select('f.id', 'f.slots', 'orders.reservedSlots')
                ->leftJoin('f.orders', 'orders')
                ->where('f.id=:val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getResult();
    }
    // /**
    //  * @return Flat[] Returns an array of Flat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Flat
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
