<?php

namespace App\Controller;

use App\Entity\MEALS;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

#[Route("/api")]

class ApiController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/get_meals', name: 'get_meals', methods:'GET')]
    public function getMeals(){
        $entityManager = $this->doctrine->getManager();
        $savedMeals = $entityManager->getRepository(MEALS::class)->findAll();
        $meals = [];
        foreach ($savedMeals as $meal) {
            $meals[] = [
                'id' => $meal->getid(),
                'meal' => $meal->getMEALNAME(),
                'small_price' => $meal->getSMALLPRICE(),
                'medium_price' => $meal->getMEDIUMPRICE(),
                'larige_price' => $meal->getLARGEPRICE()

            ];
        }
        return $this->json($meals);
    }
    
}
