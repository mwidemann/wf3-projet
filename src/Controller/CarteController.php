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
    public function index(ArticleRepository $ArticleRepository): Response
    {
        $catPlats = $ArticleRepository->CatPlats();
        $catMenus = $ArticleRepository->CatMenus();
        $catAccompagnements = $ArticleRepository->CatAccompagnements();
        $catBoissons = $ArticleRepository->CatBoissons();
        $catDesserts = $ArticleRepository->CatDesserts();
        return $this->render('carte/index.html.twig', [
            'catPlats' => $catPlats,
            'catMenus' => $catMenus,
            'catAccompagnements' => $catAccompagnements,
            'catBoissons' => $catBoissons,
            'catDesserts' => $catDesserts,
        ]);
    }
}
