<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/category/index", name="category_list")
     */
    public function category_list(){
        return $this->render('category/list.html.twig');
    }

    /**
     * @Route("/category/create", name="category_create")
     */
    public function category_create(){
        return $this->render('category/create.html.twig');
    }

    /**
     * @Route("/category/edit", name="category_edit")
     */
    public function category_edit(){
        return $this->render('category/edit.html.twig');
    }

    /**
     * @Route("/product/index", name="product_list")
     */
    public function product_list(){
        return $this->render('product/index.html.twig');
    }

    /**
     * @Route("/product/create", name="product_create")
     */
    public function product_create(){
        return $this->render('product/create.html.twig');
    }

    /**
     * @Route("/product/edit", name="product_edit")
     */
    public function product_edit(){
        return $this->render('product/edit.html.twig');
    }

}