<?php

namespace App\Controller;

use App\Form\LivraisonType;
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
