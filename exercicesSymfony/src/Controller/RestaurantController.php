<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RestaurantRepository;
use App\Entity\Restaurant;
use App\Form\RestaurantFormType;
use Doctrine\Persistence\ManagerRegistry;

class RestaurantController extends AbstractController
{
    #[Route('/restaurant', name: 'app_restaurant')]
    public function index(): Response
    {
        return $this->render('restaurant/index.html.twig', [
            'controller_name' => 'RestaurantController',
        ]);
    }

    #[Route('/restaurant/new', name: 'app_restaurant22')]
    public function addRestaurant(ManagerRegistry $doctrine,Request $request)
    {
        $restaurant= new Restaurant();
        $form=$this->createForm(RestaurantFormType::class, $restaurant);
        $form->handleRequest($request);

             if($form->isSubmitted()){
                 $entityManager = $doctrine->getManager() ;
                 $entityManager->persist($restaurant);
                 $entityManager->flush();

                 return $this->redirectToRoute("app_app");
                }
         
                return $this->render('restaurant/form.html.twig', [
                    'form' => $form->createView()
                ]);
        
    }

}
