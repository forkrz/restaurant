<?php

namespace App\Controller;

use App\Entity\MEALS;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class FrontController extends AbstractController
{
        public function __construct(private ManagerRegistry $doctrine) {}

        #[Route('/', name: 'mainPage')]
        public function index()
        {
                $entityManager = $this->doctrine->getManager();
                $savedMeals = $entityManager->getRepository(MEALS::class)->findAll();
                return $this->render('front/index.html.twig', ['meals'=>$savedMeals]);
        }

        #[Route('/order', name: 'order')]
        public function order()
        {
                return $this->render('front/order.html.twig');
        }
}
