<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */

    public function dashboard()
    {
        return $this->render('base.html.twig');
    }




}