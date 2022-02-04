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
    

}
