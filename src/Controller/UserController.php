<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */

class UserController extends AbstractController
{
    /**
     * @Route("/index", name="user_list")
     */
    public function index()
    {
        return $this->render('user/list.html.twig');
    }


    /**
     * @Route("/new", name="user_create")
     */
    public function create()
    {
        return $this->render('user/create.html.twig');
    }

    /**
     * @Route("/edit", name="user_edit")
     */
    public function user_edit()
    {
        return $this->render('user/edit.html.twig');
    }
}