<?php


namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/customer")
 */
class CustomerController extends AbstractController
{

    /**
     * @Route("/new", name="customer_create" )
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $customer = new Customer();

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            return $this->redirect($this->generateUrl('customer_list'));

        };

        return $this->render('customer/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/index", name="customer_list")
     * @param CustomerRepository $customerRepository
     * @return Response
     */
    public function list(CustomerRepository $customerRepository)
    {
        $customers = $customerRepository->findAll();

        return $this->render('customer/index.html.twig', [
            'customers' => $customers,
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Customer $customer
     * @return Response
     */
    public function show(Customer $customer)
    {
        return $this->render('customer/show.html.twig', [
            'customer' => $customer
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @param Customer $customer
     * @return Response
     */
    public function edit(Customer $customer, Request $request)
    {

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            return $this->redirect($this->generateUrl('customer_list'));

        };

        return $this->render('customer/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function delete(Customer $customer)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($customer);

        $em->flush();

        return $this->redirect($this->generateUrl('customer_list'));
    }


    /**
     * @Route("/report", name="customer_report")
     */
    public function customerReport()
    {
        return $this->render('customer/report.html.twig');

    }


}