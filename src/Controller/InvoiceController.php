<?php


namespace App\Controller;

use App\Entity\Product;
use App\Repository\SettingsRepository;
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
     * @Route("/index", name="invoice_list")
     * @return Response
     */

    public function index()
    {

        $invoices = $this->getDoctrine()->getRepository(Invoice::class)->getInvoiceDetails();

        return $this->render('invoice/index.html.twig', [
            'invoices' => $invoices,
        ]);
    }

    /**
     * @Route("/new", name="invoice_create")
     * @param Request $request
     * @param SettingsRepository $settingsRepository
     * @return Response
     */
    public function new(Request $request, SettingsRepository $settingsRepository)
    {
        $invoice = new Invoice();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($invoice);
            $em->flush();

            return $this->redirect($this->generateUrl('invoice_list'));

        };

        $vat = $settingsRepository->findOneBy(['name' => 'vat']);

        return $this->render('invoice/create.html.twig', [
            'form' => $form->createView(),
            'vat' => $vat
        ]);
    }

    /**
     * @Route("/price", name="product_price")
     * @param Request $request
     * @return Response
     */
    public function price(Request $request)
    {
        $id = $request->request->get('id');
        $row = $this->getDoctrine()->getRepository(Product::class)->getPrice($id);

        return new Response($row['price']);
    }

    /**
     * @Route("/edit/{id}", name="invoice_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Invoice $invoice
     * @param SettingsRepository $settingsRepository
     * @return Response
     */
    public function edit(Request $request, Invoice $invoice, SettingsRepository $settingsRepository): Response
    {
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush();

            return $this->redirect($this->generateUrl('invoice_list'));

        };

        $vat = $settingsRepository->findOneBy(['name' => 'vat']);
        return $this->render('invoice/create.html.twig', [
            'form' => $form->createView(),
            'vat' => $vat,
            'invoice' => $invoice

        ]);
    }


    /**
     * @Route("/show/{id}", name="invoice_show", methods={"GET"})
     * @param Invoice $invoice
     * @param SettingsRepository $settingsRepository
     * @return Response
     */
    public function show(Invoice $invoice, SettingsRepository $settingsRepository): Response
    {
        $address = $settingsRepository->findOneBy(['name' => 'shop_address']);
        $email = $settingsRepository->findOneBy(['name' => 'email']);

        return $this->render('invoice/show.html.twig', [
            'invoice' => $invoice,
            'address' => $address,
            'email' => $email,
        ]);

    }


    /**
     * @Route("/delete/{id}", name="invoice_delete")
     * @param Invoice $id
     * @return Response
     */
    public function delete(Invoice $id)
    {

        $this->getDoctrine()->getRepository(Invoice::class)->invoiceDelete($id);
        return $this->redirect($this->generateUrl('invoice_list'));
    }

}