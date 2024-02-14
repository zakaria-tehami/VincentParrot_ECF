<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\OpeningDayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(OpeningDayRepository $openingDayRepository, Request $request, MailerInterface $mailer, SessionInterface $session, EntityManagerInterface $entityManager): Response
    {
        $openingDays = $openingDayRepository->findAll();

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Save to the database
            $contact = new Contact();
            $contact->setFirstName($data->getFirstName());
            $contact->setLastName($data->getLastName());
            $contact->setEmail($data->getEmail());
            $contact->setPhoneNumber($data->getPhoneNumber());
            $contact->setContent($data->getContent());

            $entityManager->persist($contact);
            $entityManager->flush();

            // Send email
            $address = $data->getEmail();
            $content = $data->getContent();

            $email = (new Email())
                ->from($address)
                ->to('zaki.tehami@gmail.com')
                ->subject('Contact garage')
                ->text($content);

            $mailer->send($email);

            $session->getFlashBag()->add('success', 'Votre message a été envoyé avec succès.');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'openingDays' => $openingDays,
            'formulaire' => $form->createView(),
        ]);
    }
}
