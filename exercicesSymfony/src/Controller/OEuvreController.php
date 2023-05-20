<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\OEuvre;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\OeuvreFormType;
use App\Repository\OEuvreRepository;


class OEuvreController extends AbstractController
{
    #[Route('/o/euvre', name: 'app_o_euvre')]
    public function index(): Response
    {
        return $this->render('o_euvre/index.html.twig', [
            'controller_name' => 'OEuvreController',
        ]);
    }

    #[Route('/showEuvre', name: 'app_showEuvre')]
    public function afficheEuvre(OEuvreRepository $r): Response
    {
       //utiliser la fonction findAll()
        $euvres=$r->findAll();
        return $this->render('o_euvre/afficheEuvre.html.twig', [
            'euvres' => $euvres,
        ]);
    } 

    
    #[Route('/AddEuvre', name: 'app_euvre')]
    public function addEuvre(ManagerRegistry $doctrine, Request $request, SessionInterface $session)
    {

    $euvre = new OEuvre();
    $form=$this->createForm(OeuvreFormType::class,$euvre);
    $form->handleRequest($request);

     if($form->isSubmitted() && $form->isValid()){
         $em =$doctrine->getManager() ;
         $em->persist($euvre);
         $em->flush();
         $session->getFlashBag()->add('success', 'L\'entité a été ajoutée avec succès.');
         //return $this->redirectToRoute("afficheStudent");}
     }
         return $this->render('o_euvre/formEuvrest.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
