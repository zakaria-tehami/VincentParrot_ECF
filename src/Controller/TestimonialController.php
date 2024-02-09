<?php

namespace App\Controller;

use App\Entity\Testimonial;
use App\Repository\OpeningDayRepository;
use App\Repository\TestimonialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class TestimonialController extends AbstractController
{
    #[Route('/testimonial', name: 'app_testimonial')]
    public function index(TestimonialRepository  $testimonialRepository, OpeningDayRepository $openingDayRepository): Response
    {
        $testimonials = $testimonialRepository->findAll();
        $openingDays = $openingDayRepository->findAll();

        return $this->render('testimonial/index.html.twig', [
            'testimonials' => $testimonials,
            'openingDays' => $openingDays,
        ]);
    }
    private $entityManager; // Ajoutez une propriété privée pour le gestionnaire d'entités

    // Injectez le gestionnaire d'entités dans le constructeur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function submitTestimonial(Request $request): Response
    {
        $pseudo = $request->request->get('pseudonym');
        $content = $request->request->get('floatingTextarea2');
        $note = $request->request->get('rating');

        // Créer une nouvelle instance de l'entité Testimonial
        $testimonial = new Testimonial();
        $testimonial->setPseudo($pseudo);
        $testimonial->setContent($content);
        $testimonial->setNote($note);
        $testimonial->setApproved(false); // L'avis n'est pas approuvé par défaut

        // Enregistrer l'avis dans la base de données
        $this->entityManager->persist($testimonial);
        $this->entityManager->flush();

        // Rediriger vers la page d'accueil (ou une autre page) après la soumission
        return $this->redirectToRoute('app_home');
    }
}
