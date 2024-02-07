<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\OpeningDayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/car/{slug}', name: 'car_detail')]
public function carDetail(string $slug, CarRepository $carRepository, OpeningDayRepository $openingDayRepository): Response
{
    // Récupérer la voiture par le slug depuis le repository
    $car = $carRepository->findOneBy(['slug' => $slug]);
    $openingDays = $openingDayRepository->findAll();

    // Vérifier si la voiture existe
    if (!$car) {
        throw $this->createNotFoundException('Car not found');
    }

    // Passer la voiture à la vue
    return $this->render('car/carDetail.html.twig', [
        'car' => $car,
        'openingDays' => $openingDays,
    ]);
}
    #[Route('/car', name: 'car_list')]
    public function carList(OpeningDayRepository $openingDayRepository): Response
    {
        $openingDays = $openingDayRepository->findAll();
        // Ajoutez ici la logique pour récupérer la liste des voitures

        return $this->render('car/carDetail.html.twig', [
            'openingDays' => $openingDays,
        ]);
    }

    #[Route('/cars', name: 'cars_list')]
public function carsList(CarRepository $carRepository, OpeningDayRepository $openingDayRepository): Response
{
    // Récupérer la liste des voitures depuis le repository
    $cars = $carRepository->findAll();
    $openingDays = $openingDayRepository->findAll();

    // Passer la liste des voitures à la vue
    return $this->render('car/cars_list.html.twig', [
        'cars' => $cars,
        'openingDays' => $openingDays,
    ]);
}


}
