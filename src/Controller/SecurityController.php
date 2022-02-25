<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\MEALS;

class SecurityController extends AbstractController
{
    /**
     * @Route("admin/login", name="admin_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $savedMeals = $entityManager->getRepository(MEALS::class)->findAll();

        if ($this->getUser()) {
            return $this->render('admin/mainPage.html.twig',['meals'=> $savedMeals]);
        }


        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): void
    {

    }
}
