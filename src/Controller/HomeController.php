<?php

namespace App\Controller;

use App\Repository\OpeningDayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(OpeningDayRepository $openingDayRepository): Response
    {
        $openingDays = $openingDayRepository->findAll();

        return $this->render('home/index.html.twig', [
            'openingDays' => $openingDays,
        ]);
    }
}
