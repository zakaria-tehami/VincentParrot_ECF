<?php

namespace App\Controller;

use App\Repository\OpeningDayRepository;
use App\Repository\TestimonialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
