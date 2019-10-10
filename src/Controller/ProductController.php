<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/index", name="product_list")
     */
    public function productList(){
        return $this->render('product/index.html.twig');
    }

    /**
     * @Route("/product/create", name="product_create")
     */
    public function productCreate(){
        return $this->render('product/create.html.twig');
    }

    /**
     * @Route("/product/edit", name="product_edit")
     */
    public function productEdit(){
        return $this->render('product/edit.html.twig');
    }

}