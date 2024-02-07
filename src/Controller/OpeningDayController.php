<?php

namespace App\Controller;

use App\Repository\OpeningDayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpeningDayController extends AbstractController
{
    #[Route('/opening-day', name: 'app_opening_day')]
    public function index(OpeningDayRepository $openingDayRepository): Response
    {
        $openingDays = $openingDayRepository->findAll();
        return $this->render('opening_day/opening_day.html.twig', [
            'openingDays' => $openingDays,
        ]);
    }
}
