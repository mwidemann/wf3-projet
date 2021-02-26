<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $ArticleRepository, Request $request, \Swift_Mailer $mailer): Response
    {
        $topPlat = $ArticleRepository->findTopPlat();
        $contactForm = $this->createForm(ContactType::class);
        $contactForm->handleRequest($request);

        if($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contact = $contactForm->getData();
            $mail = (new \Swift_Message('Sushi - contact'))
                ->setFrom($contact['email'])
                ->setTo('prospercolugo@gmail.com') 
                ->setBody(
                    $this->renderView(
                        'home/emailContact.html.twig', [
                            'prenom' => $contact['prenom'],
                            'nom' => $contact['nom'],
                            'email' => $contact['email'],
                            'objet' => $contact['objet'],
                            'message' => $contact['message']
                        ]
                    ),
                    'text/html'
                )
            ;
            $mailer->send($mail);
            $this->addFlash(
                'success',
                'Votre message a bien été envoyé'
            );
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'topPlat' => $topPlat,
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
