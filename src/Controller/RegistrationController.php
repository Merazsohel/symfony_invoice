<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        $this->addFlash('info', 'Registration Successful.Please Check Your Email!');
        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            $message = (new \Swift_Message('Registration Successful!'))
                ->setFrom('merazhossain64@gmail.com')
                ->setTo($contactFormData->getEmail())
                ->setBody(
                    $this->render('registration/successMessage.html.twig', [
                        'username' => $contactFormData->getUsername()
                    ]),
                    'text/html'
                );

            $mailer->send($message);

            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }


}