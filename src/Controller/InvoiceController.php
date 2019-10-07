<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    /**
     * @Route("/invoice/create", name="invoice_create")
     */
    public function index(){
        return $this->render('invoice/create.html.twig');
    }
}