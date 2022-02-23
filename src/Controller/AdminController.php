<?php

namespace App\Controller;

use App\Entity\MEALS;
use App\Entity\ORDERS;
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
        $savedMeals = $entityManager->getRepository(MEALS::class)->findAll();
        return $this->render('admin/mainPage.html.twig', ['meals'=>$savedMeals]);
    }

    #[Route('/edit_meal', name: 'edit_meal', methods:'GET')]
    public function editMeal(Request $request){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $entityManager = $this->doctrine->getManager();
        $id = $request->query->get('id');
        $meal = $entityManager->getRepository(MEALS::class)->findBy(array('id'=>$id));
        $id = $request->query->get('id');
        if (!$id) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->render('admin/editMeal.html.twig', ['ids'=>$id, 'meals'=>$meal[0]]);
    }

    #[Route('/edit_meal_db', name: 'edit_meal_db', methods:'POST')]
    public function editMealDB(Request $request){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $entityManager = $this->doctrine->getManager();
        
        $id = $request->query->get('id');

        $name = $request->request->get('Name');
        $smallPrice = $request->request->get('smallPrice');
        $mediumPrice = $request->request->get('mediumPrice');
        $largePrice = $request->request->get('largePrice');

        if($name == null or $smallPrice == null or $mediumPrice == null or $largePrice == null){
            $this->addFlash(
                'error',
                'All fields must be completed'
                );
                return $this->redirectToRoute('edit_meal');
        }

        if($entityManager->getRepository(MEALS::class)->findBy(array('MEAL_NAME'=>$name)) != null){
            $this->addFlash(
            'error',
            'Meal with this name already exist'
            );
            return $this->redirectToRoute('main_page');
            }else{
                $meal = $entityManager->getRepository(MEALS::class)->find($id);
                $meal-> setMEALNAME($name);
                $meal->setSMALLPRICE($smallPrice);
                $meal->setMEDIUMPRICE($mediumPrice);
                $meal->setLARGEPRICE($largePrice);
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    'Meal has been modified'
                    );
                    return $this->redirectToRoute('main_page');
            }            
    }

    #[Route('/delete_meal_db', name: 'delete_meal_db', methods:'POST|GET')]
    public function deleteMealDB(Request $request){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $entityManager = $this->doctrine->getManager();

        $id = $request->query->get('id');

        if (!$id) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $meal = $entityManager->getRepository(MEALS::class)->find($id);
        $entityManager->remove($meal);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'Meal has been deleted'
            );
        return $this->redirectToRoute('main_page');
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
            'Meal already exist'
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
        $entityManager = $this->doctrine->getManager();
        $ordersDB = $entityManager->getRepository(ORDERS::class)->findAll();
        return $this->render('admin/orders.html.twig',['orders'=>$ordersDB]);
    }

    #[Route('/order_details', name: 'order_details')]
    public function orderDetails(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('admin/orderDetails.html.twig');
    }

}
