<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'mainPage')]
    public function index()
    {
            return $this->render('front/index.html.twig');
    }

    #[Route('/order', name: 'order')]
    public function order()
    {
            return $this->render('front/order.html.twig');
    }
}
