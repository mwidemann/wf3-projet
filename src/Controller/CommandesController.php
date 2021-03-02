<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandesController extends AbstractController
{
    /**
     * @Route("/user/commandes", name="user_commandes")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        $commandes = $orderRepository->findOrder($this->getUser()->getId());
        
        return $this->render('user/commandes.html.twig', [
            'commandes' => $commandes,
        ]);
    }
}
