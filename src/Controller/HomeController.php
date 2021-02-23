<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $contactForm = $this->createForm(ContactType::class);
        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contact = $contactForm->getData();
            $mail = (new \Swift_Message('Lorem ipsum objet'))
                ->setFrom($contact['email'])
                ->setTo('antoine.trisse@gmail.com')
                ->setBody(
                    $this->renderView(
                        'contact/emailContact.html.twig', [
                            'nom' => $contact['nom'],
                            'prenom' => $contact['prenom'],
                            'email' => $contact['email'],
                            'objet' => $contact['objet'],
                            'message' => $contact['message'],
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
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
