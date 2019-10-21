<?php

namespace App\Controller;

use App\Entity\Settings;
use App\Form\SettingsType;
use App\Repository\SettingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/settings")
 */
class SettingsController extends AbstractController
{
    /**
     * @Route("/index", name="settings_index", methods={"GET"})
     * @param SettingsRepository $settingsRepository
     * @return Response
     */
    public function index(SettingsRepository $settingsRepository): Response
    {
        return $this->render('settings/index.html.twig', [
            'settings' => $settingsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="settings_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $setting = new Settings();
        $form = $this->createForm(SettingsType::class, $setting);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($setting);
            $entityManager->flush();

            return $this->redirectToRoute('settings_index');
        }

        return $this->render('settings/new.html.twig', [
            'setting' => $setting,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="settings_show", methods={"GET"})
     * @param Settings $setting
     * @return Response
     */
    public function show(Settings $setting): Response
    {
        return $this->render('settings/show.html.twig', [
            'setting' => $setting,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="settings_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Settings $setting
     * @return Response
     */
    public function edit(Request $request, Settings $setting): Response
    {
        $form = $this->createForm(SettingsType::class, $setting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('settings_index');
        }

        return $this->render('settings/edit.html.twig', [
            'setting' => $setting,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="settings_delete", methods={"DELETE"})
     * @param Request $request
     * @param Settings $setting
     * @return Response
     */
    public function delete(Request $request, Settings $setting): Response
    {
        if ($this->isCsrfTokenValid('delete'.$setting->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($setting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('settings_index');
    }
}
