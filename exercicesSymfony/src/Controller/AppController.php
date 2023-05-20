<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\RestaurantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_app')]
    public function index(RestaurantRepository $r): Response
    {

        $restaurents = $r->findLastTenElements();
        $allRestaurant = $r->findAll();

        return $this->render('app/index.html.twig', [
            'restaurants' => $restaurents,
            'allRestaurant' => $allRestaurant
        ]);
    }

    
}
