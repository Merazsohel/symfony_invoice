<?php

namespace App\Repository;

use App\Entity\InvoiceDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method InvoiceDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvoiceDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvoiceDetail[]    findAll()
 * @method InvoiceDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvoiceDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InvoiceDetail::class);
    }

    // /**
    //  * @return SaleDetail[] Returns an array of SaleDetail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SaleDetail
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
