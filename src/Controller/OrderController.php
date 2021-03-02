<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Form\LivraisonType;
use App\Repository\ArticleRepository;
use App\Repository\LivraisonRepository;
use App\Repository\UserLivraisonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("/order-{id}", name="order")
     */
    public function index(LivraisonRepository $livraisonRepository, UserLivraisonRepository $userLivraisonRepository, ArticleRepository $articleRepository, SessionInterface $session, Request $request, $id): Response
    {
        // On récupère le panier
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
        // 

        $livraison = $livraisonRepository->find($id);

        $order = new Order();

        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $order->setNumero(" ");
            $order->setSomme($total);
            // $order->setAdresseLivraison($livraison->getAddNom() . ", " . $livraison->getAddPrenom() . ", " . $livraison->getAdresse() . ", " . $livraison->getComplement() . ", " . $livraison->getCp() . ", " . $livraison->getVille());
            $order->setAdresseLivraison("salut");
            $order->setStatut("preparation");
            $order->setCartId(1);
            $order->setUserId($this->getUser()->getId());

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($order);
            $manager->flush();

            $order->setNumero(strval($order->getId()));

            $manager->persist($order);
            $manager->flush();

            $this->addFlash('success', 'Votre commande a bien été prise en compte');

            return $this->redirectToRoute('home');
        }
        
        return $this->render('order/index.html.twig', [
            'orderForm' => $form->createView(),
        ]);
    }
}
