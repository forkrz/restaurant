<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route("/admin")]

class AdminController extends AbstractController
{
    #[Route('/login', name: 'admin_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('admin/login.html.twig', [
            'controller_name' => 'LoginController',
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('admin/register.html.twig');
    }

    
    #[Route('/main_page', name: 'main_page')]
    public function mainPage(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('admin/mainPage.html.twig');
    }

    #[Route('/edit_meal', name: 'edit_meal')]
    public function editMeal(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('admin/editMeal.html.twig');
    }

    #[Route('/add_meal', name: 'add_meal')]
    public function addMeal(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('admin/addMeal.html.twig');
    }

    #[Route('/orders', name: 'orders')]
    public function orders(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('admin/orders.html.twig');
    }

    #[Route('/order_details', name: 'order_details')]
    public function orderDetails(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('admin/orderDetails.html.twig');
    }

}
