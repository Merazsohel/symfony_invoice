<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class SettingsController extends AbstractController
{
    /**
     * @Route("/settings/index", name="settings_list")
     */
    public function settings_list(){

        return $this->render('settings/settings_list.html.twig');

    }
    /**
     * @Route("/settings/create", name="settings_create")
     */
    public function settings_create(){

            return $this->render('settings/settings_create.html.twig');

    }

    /**
     * @Route("/settings/edit", name="settings_edit")
     */
    public function settings_edit(){

            return $this->render('settings/settings_edit.html.twig');

    }
}