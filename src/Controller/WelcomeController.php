<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function login()
    {
        return $this->render('admin/login.html.twig');

    }

    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */

    public function dashboard()
    {
        return $this->render('base.html.twig');
    }




}