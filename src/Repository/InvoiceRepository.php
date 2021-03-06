<?php

namespace App\Repository;

use App\Entity\Invoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Invoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Invoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Invoice[]    findAll()
 * @method Invoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }

    public function getInvoiceDetails(){
        return $this->createQueryBuilder('i')
                ->join('i.invoiceDetails','d')
                ->join('d.product','p')
                ->join('i.customer','c')
                ->select('p.name,p.price,i.id,i.BillDate,i.BillNumber,i.subtotal,i.vat,i.discount,c.email,c.address')
                ->groupBy('i.id')
                ->getQuery()
                ->getResult();
    }

    public function invoiceDelete($invoice){
        $this->_em->remove($invoice);
        $this->_em->flush();
    }

    public function getSalesReport($from,$to){
        return $this->createQueryBuilder('i')
                ->select('i.BillDate,i.BillNumber,i.subtotal')
                ->andWhere('i.BillDate BETWEEN  :from AND :to')
                ->setParameter('from', $from )
                ->setParameter('to', $to)
                ->getQuery()
                ->getResult();
    }

    public function saleCount($from,$to){
        return $this->createQueryBuilder('i')
            ->select('SUM(i.subtotal) as subCount')
            ->where('i.BillDate BETWEEN  :from AND :to')
            ->setParameter('from', $from )
            ->setParameter('to', $to)
            ->getQuery()
            ->getResult();

    }


    // /**
    //  * @return Invoice[] Returns an array of Invoice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Invoice
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
