<?php


namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Invoice;
use App\Form\InvoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/invoice")
 */
class InvoiceController extends AbstractController
{
    /**
     * @Route("/new", name="invoice_create")
     * @param Request $request
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function new(Request $request, ProductRepository $productRepository){
        $invoice = new Invoice();

        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

//          $test =  $invoice->getInvoiceDetails();
//            var_dump($test);
//            exit();

            $em->persist($invoice);
            $em->flush();

            return $this->redirect($this->generateUrl('invoice_create'));

        };
        $products = $productRepository->findAll();
        return $this->render('invoice/create.html.twig',[
            'form' => $form->createView(),
            'products' => $products
        ]);
    }
}