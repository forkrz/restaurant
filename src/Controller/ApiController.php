<?php

namespace App\Controller;

use App\Entity\MEALS;
use App\Entity\ORDERDETAILS;
use App\Entity\ORDERS;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Utils\ApiData;
use App\Utils\OrdersData;


#[Route("/api")]

class ApiController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    #[Route('/get_meals', name: 'get_meals', methods: 'GET')]
    public function getMeals()
    {
        $entityManager = $this->doctrine->getManager();
        $savedMeals = $entityManager->getRepository(MEALS::class)->findAll();
        $meals = [];
        foreach ($savedMeals as $meal) {
            $meals[] = [
                'id' => $meal->getid(),
                'meal' => $meal->getMEALNAME(),
                'small_price' => $meal->getSMALLPRICE(),
                'medium_price' => $meal->getMEDIUMPRICE(),
                'large_price' => $meal->getLARGEPRICE()

            ];
        }
        return $this->json($meals);
    }

    #[Route('/xd', name: 'xd', methods: 'get')]
    public function test(){
        $ordersData = new OrdersData($this->doctrine);
        $response = new Response;

        $response->setContent($ordersData->getLastOrderId());
        return $response->send();
    }

    #[Route('/save_order', name: 'save_order', methods: 'post')]
    public function saveOrder(Request $request, ApiData $apiData)
    {

        $entityManager = $this->doctrine->getManager();

        $names = $request->get('Names');
        $sizes = $request->get('Sizes');
        $qtys = $request->get('Qtys');
        $price = $apiData->countTotalPrice($names, $sizes, $qtys);
        $orders = new ORDERS;
        $orderDetails = new ORDERDETAILS;
        $ordersData = new OrdersData($this->doctrine);

        $orders->setDATEOFORDER(new \DateTime());
        $orders->setTOTALCOST($price);
        $entityManager->persist($orders);
        $entityManager->flush();

        foreach ($names as $i => $name) {
            $orderDetails->setORDERID($ordersData->getLastOrderId());
            $orderDetails->setMEALNAME($name);
            $orderDetails->setMEALSIZE($sizes[$i]);
            $orderDetails->setQUANTITY($qtys[$i]);
            $orderDetails->setPrice($apiData->getPrice($names,$sizes,$i));
            $entityManager->persist($orderDetails);
            $entityManager->flush();
            $entityManager->clear();
        }
        $this->addFlash(
            'success',
            count($names)
        );

        $response = new Response;

        $response->setContent('order placed');
        return $response->send();
    }
}
