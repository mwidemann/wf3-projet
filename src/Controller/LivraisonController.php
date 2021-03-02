<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Form\LivraisonType;
use App\Entity\UserLivraison;
use App\Repository\ArticleRepository;
use App\Repository\LivraisonRepository;
use App\Repository\UserLivraisonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivraisonController extends AbstractController
{
    /**
     * @Route("/livraison", name="livraison")
     */
    public function index(LivraisonRepository $livraisonRepository, UserLivraisonRepository $userLivraisonRepository, ArticleRepository $articleRepository, SessionInterface $session): Response
    {
        $adresses_id = $userLivraisonRepository->findAdresses($this->getUser()->getId());
        $adresses = $livraisonRepository->findAll();

        $panier = $session->get('panier', []);
        $panierRempli = [];
        
        foreach ($panier as $id => $quantite)
        {
            $panierRempli[] = [
                'article' => $articleRepository->find($id),
                'quantite' => $quantite
            ];
        }
        
        $total = 0;
        
        foreach ($panierRempli as $item)
        {
            $totalItem = $item['article']->getPrix() * $item['quantite'];
            $total += $totalItem;
        }
        
        return $this->render('livraison/index.html.twig', [
            'adresses_id' => $adresses_id,
            'adresses' => $adresses,
            'items' => $panierRempli,
            'total' => $total
        ]);
    }

    /**
     * @Route("/livraison/create", name="livraison_create")
     */
    public function createAdresse(Request $request)
    {
        $livraison = new Livraison();
        $user_livraison = new UserLivraison();
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);
        if ($form->isSubmitted()) 
        {
            if ($form->isValid())
            {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($livraison);
                $manager->flush();
                
                $user_livraison->setLivraisonId($livraison->getId());
                $user_livraison->setUserId($this->getUser()->getId());
                $manager->persist($user_livraison);
                $manager->flush();

                $this->addFlash('success', 'L\'adresse a bien été ajoutée.');
            }
            else
                $this->addFlash('danger','Une erreur est survenue lors de l\'ajout de l\'adresse.');
                
            return $this->redirectToRoute('livraison');
        }
        return $this->render('livraison/livraisonForm.html.twig', [
            'livraisonForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/livraison/update-{id}", name="livraison_update")
     */
    public function updateLivraison(LivraisonRepository $livraisonRepository, $id, Request $request)
    {
        $livraison = $livraisonRepository->find($id);
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($livraison);
            $manager->flush();

            $this->addFlash('success', 'L\'adresse a bien été modifiée.');

            return $this->redirectToRoute('livraison');
        }
        return $this->render('livraison/livraisonForm.html.twig', [
            'livraisonForm' => $form->createView()
        ]);
    }
}
