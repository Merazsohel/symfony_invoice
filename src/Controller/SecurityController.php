<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     * @throws \Exception
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/forgotPassword", name="forgotPassword")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param UserRepository $userRepository
     * @return Response
     */

    public function forgot(Request $request, UserPasswordEncoderInterface $encoder, UserRepository $userRepository)
    {

        $userInfo = ['username' => null, 'password' => null];

        $form = $this->createForm(ChangePasswordType::class, $userInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userInfo = $form->getData();
            $username = $userInfo['username'];
            $plainPassword = $userInfo['password'];

            $user = $userRepository->findOneBy(['username' => $username]);
            if ($user === null) {
                $this->addFlash('danger', 'Invalid username');
                return $this->redirect($this->generateUrl('user_registration'));
            }
            $password = $encoder->encodePassword($user, $plainPassword);

            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('user_registration'));
        }

        return $this->render('security/forgot.html.twig', array('form' => $form->createView()));
    }


}
