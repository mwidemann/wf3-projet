<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $ArticleRepository): Response
    {
        $topPlat = $ArticleRepository->findTopPlat();
        return $this->render('home/index.html.twig', [
            'topPlat' => $topPlat,
        ]);
    }
}
