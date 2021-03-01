<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    /**
     * @Route("/carte", name="carte")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        $catPlats = $articleRepository->catPlats();
        $catMenus = $articleRepository->catMenus();
        $catAccompagnements = $articleRepository->catAccompagnements();
        $catBoissons = $articleRepository->catBoissons();
        $catDesserts = $articleRepository->catDesserts();
        return $this->render('carte/index.html.twig', [
            'catPlats' => $catPlats,
            'catMenus' => $catMenus,
            'catAccompagnements' => $catAccompagnements,
            'catBoissons' => $catBoissons,
            'catDesserts' => $catDesserts,
            'articles' => $articleRepository->findAll(),
        ]);
    }
}
