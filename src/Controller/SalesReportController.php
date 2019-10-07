<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SalesReportController extends AbstractController
{
    /**
     * @Route("/sales/report", name="sales_report")
     */
    public function index(){
        return $this->render('sales/report.html.twig');
    }

}