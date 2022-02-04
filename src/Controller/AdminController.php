<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin")]

class AdminController extends AbstractController
{
    #[Route('/login', name: 'admin_login')]
    public function login(){
        return $this->render('admin/login.html.twig');
    }
    
    #[Route('/main_page', name: 'main_page')]
    public function mainPage(){
        return $this->render('admin/mainPage.html.twig');
    }

    #[Route('/edit_meal', name: 'edit_meal')]
    public function editMeal(){
        return $this->render('admin/editMeal.html.twig');
    }

}
