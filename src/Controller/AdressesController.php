<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Form\AdresseType;
use App\Form\LivraisonType;
use App\Entity\UserLivraison;
use App\Repository\LivraisonRepository;
use App\Repository\UserLivraisonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdressesController extends AbstractController
{
    /**
     * @Route("/user/adresses", name="user_adresses")
     */
    public function index(LivraisonRepository $livraisonRepository, UserLivraisonRepository $userLivraisonRepository): Response
    {
        $adresses_id = $userLivraisonRepository->findAdresses($this->getUser()->getId());
        $adresses = $livraisonRepository->findAll();
        

        return $this->render('user/adresses.html.twig', [
            'adresses_id' => $adresses_id,
            'adresses' => $adresses,
        ]);
    }

    /**
     * @Route("/user/adresses/create", name="adresse_create")
     */
    public function createAdresse(Request $request)
    {
        $adresse = new Livraison();
        $user_livraison = new UserLivraison();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);
        if ($form->isSubmitted()) 
        {
            if ($form->isValid())
            {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($adresse);
                $manager->flush();
                
                $user_livraison->setLivraisonId($adresse->getId());
                $user_livraison->setUserId($this->getUser()->getId());
                $manager->persist($user_livraison);
                $manager->flush();

                $this->addFlash('success', 'L\'adresse a bien été ajoutée.');
            }
            else
                $this->addFlash('danger','Une erreur est survenue lors de l\'ajout de l\'adresse.');
                
            return $this->redirectToRoute('user_adresses');
        }
        return $this->render('user/adresseForm.html.twig', [
            'adresseForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/adresses/update-{id}", name="adresse_update")
     */
    public function updateLivraison(LivraisonRepository $livraisonRepository, $id, Request $request)
    {
        $livraison = $livraisonRepository->find($id);
        $form = $this->createForm(AdresseType::class, $livraison);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($livraison);
            $manager->flush();

            $this->addFlash('success', 'L\'adresse a bien été modifiée.');

            return $this->redirectToRoute('user_adresses');
        }
        return $this->render('user/adresseForm.html.twig', [
            'adresseForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/adresses/delete-{id}", name="adresse_delete")
     */
    public function deleteAdresse(LivraisonRepository $livraisonRepository, UserLivraisonRepository $userLivraisonRepository, $id)
    {
        $userLivraison = $userLivraisonRepository->find($id);
        $adresse = $livraisonRepository->find($userLivraison->getLivraisonId());

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($userLivraison);
        $manager->remove($adresse);
        $manager->flush();

        $this->addFlash('success','L\'adresse a bien été supprimé.');

        return $this->redirectToRoute('user_adresses');
    }
}
