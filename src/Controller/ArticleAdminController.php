<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Form\ArticleUpdateType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/articles", name="admin_articles")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        return $this->render('admin/article.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/admin/articles/create", name="article_create")
     */
    public function createArticle(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted()) 
        {
            if ($form->isValid())
            {
                $infoImg = $form['photo']->getData(); // récupère les infos de l'image 1
                $extensionImg = $infoImg->guessExtension(); // récupère le format de l'image 1
                $nomImg = 'article-' . time() . '.' . $extensionImg; // compose un nom d'image unique
                $infoImg->move($this->getParameter('dossier_photos_articles'), $nomImg); // déplace l'image
                $article->setPhoto($nomImg);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($article);
                $manager->flush();

                $this->addFlash('success', 'L\'article a bien été ajouté.');

            }
            else
                $this->addFlash('danger','Une erreur est survenue lors de l\'ajout de l\'article.');
                
            return $this->redirectToRoute('admin_articles');
        }
        return $this->render('admin/articleForm.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/articles/update-{id}", name="article_update")
     */
    public function updateArticle(ArticleRepository $articleRepository, $id, Request $request)
    {
        $article = $articleRepository->find($id);
        $form = $this->createForm(ArticleUpdateType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if ($form['photo']->getData())
            {
                $oldNomImg = $article->getPhoto();
                $oldCheminImg = $this->getParameter('dossier_photos_articles') . '/' . $oldNomImg;
                if (file_exists($oldCheminImg))
                unlink($oldCheminImg);
                
                $infoImg = $form['photo']->getData();
                $extensionImg = $infoImg->guessExtension();
                $nomImg = 'article-' . time() . '.' . $extensionImg;
                $infoImg->move($this->getParameter('dossier_photos_articles'), $nomImg);
                $article->setPhoto($nomImg);
            }
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', 'L\'article a bien été modifié.');

            return $this->redirectToRoute('admin_articles');
        }
        return $this->render('admin/articleUpdateForm.html.twig', [
            'articleUpdateForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/articles/delete-{id}", name="article_delete")
     */
    public function deleteArticle(ArticleRepository $articleRepository, $id)
    {
        $article = $articleRepository->find($id);
        $oldNomImg = $article->getPhoto();
        $oldCheminImg = $this->getParameter('dossier_photos_articles') . '/' . $oldNomImg;
        if (file_exists($oldCheminImg)) {
            unlink($oldCheminImg);
        }
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($article);
        $manager->flush();

        $this->addFlash('success','L\'article a bien été supprimé.');

        return $this->redirectToRoute('admin_articles');
    }
}