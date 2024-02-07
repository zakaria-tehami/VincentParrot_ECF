<?php

namespace App\Controller;

use App\Repository\OpeningDayRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function servicesList(ServiceRepository $serviceRepository, OpeningDayRepository $openingDayRepository): Response
    {
        // Récupérer la liste des services depuis le repository
        $services = $serviceRepository->findAll();
        $openingDays = $openingDayRepository->findAll();

        // Passer la liste des services à la vue
        return $this->render('service/services_list.html.twig', [
            'services' => $services,
            'openingDays' => $openingDays,
        ]);
    }
}
