<?php


namespace App\Controller;

use App\Entity\Invoice;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SalesReportController extends AbstractController
{

    /**
     * @Route("/sales/report", name="get_sales_report",methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function report(Request $request){

        if ($request){
            $from = $request->request->get('from');
            $to = $request->request->get('to');

            $sales =  $this->getDoctrine()->getRepository(Invoice::class)->getSalesReport($from,$to);
            $salesCount =  $this->getDoctrine()->getRepository(Invoice::class)->saleCount($from,$to);

            return $this->render('sales/report.html.twig',[
                'sales' => $sales,
                'salesCount' => $salesCount,
            ]);
        }

        return $this->render('sales/report.html.twig');
    }

}