<?php

namespace App\Controller;

use App\Entity\MEALS;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

#[Route("/admin")]

class AdminController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}

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
        $entityManager = $this->doctrine->getManager();
        $entityManager = $this->doctrine->getManager();
        $savedMeals = $entityManager->getRepository(MEALS::class)->findAll();
        return $this->render('admin/mainPage.html.twig', ['meals'=>$savedMeals]);
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

    #[Route('/add_meal_db', name: 'add_meal_db', methods:'POST')]
    public function addMealDb(Request $request){
        $entityManager = $this->doctrine->getManager();

        $name = $request->request->get('Name');
        $smallPrice = $request->request->get('smallPrice');
        $mediumPrice = $request->request->get('mediumPrice');
        $largePrice = $request->request->get('largePrice');

        if($name == null or $smallPrice == null or $mediumPrice == null or $largePrice == null){
            $this->addFlash(
                'error',
                'All fields must be completed'
                );
                return $this->redirectToRoute('add_meal');
        }


        if($entityManager->getRepository(MEALS::class)->findBy(array('MEAL_NAME'=>$name)) != null){
            $this->addFlash(
            'error',
            'Meal already existed'
            );
            return $this->redirectToRoute('main_page');
            }else{
                $meals = new MEALS;
                $meals-> setMEALNAME($name);
                $meals->setSMALLPRICE($smallPrice);
                $meals->setMEDIUMPRICE($mediumPrice);
                $meals->setLARGEPRICE($largePrice);
                $entityManager->persist($meals);
                $entityManager->flush();
        
                $this->addFlash(
                    'success',
                    'Meal has been added'
                );
        
                return $this->redirectToRoute('main_page');

            }

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
