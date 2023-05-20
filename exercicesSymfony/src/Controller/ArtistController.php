<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArtistRepository;
use App\Form\ArtistFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Artist;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Session\SessionInterface;


class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'app_artist')]
    public function index(): Response
    {
        return $this->render('artist/index.html.twig', [
            'controller_name' => 'ArtistController',
        ]);
    }

    #[Route('/Addartist', name: 'app_artist')]
    public function addArtist(ManagerRegistry $doctrine, Request $request, SessionInterface $session)
    {
        $artist= new Artist();
    $form=$this->createForm(ArtistFormType::class,$artist);
    $form->handleRequest($request);
     if($form->isSubmitted() && $form->isValid()){
         $em =$doctrine->getManager() ;
         $em->persist($artist);
         $em->flush();
         $session->getFlashBag()->add('success', 'L\'entité a été ajoutée avec succès.');
         //return $this->redirectToRoute("afficheStudent");}
     }
         return $this->render('artist/formArtist.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/showArtist', name: 'app_showartist')]
    public function afficheArtist(ArtistRepository $r): Response
    {
       //utiliser la fonction findAll()
        $artists=$r->findAll();
        return $this->render('artist/afficheArtist.html.twig', [
            'artists' => $artists,
        ]);
    } 

    #[Route('/detail/{id}', name: 'detail_artist')]
    public function detail_artist($id, EntityManagerInterface $entityManager): Response
    {
       //utiliser la fonction findAl()
       $artist = $entityManager->getRepository(Artist::class)->find($id);

        return $this->render('artist/detailsArtist.html.twig', [
            'artist' => $artist,
        ]);
    }  

    #[Route('/artist/{id}', name: 'delete_artist')]
    public function delete_artist($id, EntityManagerInterface $entityManager): Response
    {

        $artist = $entityManager->getRepository(Artist::class)->find($id);

        if(!$artist) {
            throw $this->createNotFoundException('Aucune voiture trouvé avec cet id '.$id);
        }

        $entityManager->remove($artist);
        $entityManager->flush();
        return $this->redirectToRoute('app_showartist');
    }

    #[Route('/updateArtist/{id}', name: 'update_artist')]
    public function updateArtist(ManagerRegistry $doctrine, Request $request, $id, EntityManagerInterface $entityManager)
   {

    $artist = $entityManager->getRepository(Artist::class)->find($id);
    $form=$this->createForm(ArtistFormType::class,$artist);
    $form->handleRequest($request);

            if($form->isSubmitted()){
                $em =$doctrine->getManager() ;
                $em->flush();
            return $this->redirectToRoute("app_showartist");
        }
        
            return $this->render('artist/formArtist.html.twig', [
                    'form' => $form->createView()
                ]);
     }

}
