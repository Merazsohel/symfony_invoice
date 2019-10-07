<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/user/index", name="user_list")
     */
    public function index(){
        return $this->render('user/list.html.twig');
    }


    /**
     * @Route("/user/create", name="user_create")
     */
    public function create(){
        return $this->render('user/create.html.twig');
    }

    /**
     * @Route("/user/edit", name="user_edit")
     */
    public function edit(){
        return $this->render('user/edit.html.twig');
    }

    /**
     * @Route("/customer/create", name="customer_create")
     */
    public function customer_create(){
        return $this->render('user/customer_create.html.twig');
    }

    /**
     * @Route("/customer/index", name="customer_list")
     */
    public function customer_list(){
        return $this->render('user/customer_list.html.twig');
    }

    /**
     * @Route("/customer/edit", name="customer_edit")
     */
    public function customer_edit(){
        return $this->render('user/customer_edit.html.twig');
    }

    /**
     * @Route("/customer/report", name="customer_report")
     */
    public function customer_report(){
        return $this->render('user/customer_report.html.twig');
    }
}