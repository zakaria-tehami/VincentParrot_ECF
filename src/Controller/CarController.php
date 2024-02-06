<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/car/{slug}', name: 'car_detail')]
public function carDetail(string $slug, CarRepository $carRepository): Response
{
    // Récupérer la voiture par le slug depuis le repository
    $car = $carRepository->findOneBy(['slug' => $slug]);

    // Vérifier si la voiture existe
    if (!$car) {
        throw $this->createNotFoundException('Car not found');
    }

    // Passer la voiture à la vue
    return $this->render('car/carDetail.html.twig', [
        'car' => $car,
    ]);
}
    #[Route('/car', name: 'car_list')]
    public function carList(): Response
    {
        // Ajoutez ici la logique pour récupérer la liste des voitures

        return $this->render('car/carDetail.html.twig');
    }

    #[Route('/cars', name: 'cars_list')]
public function carsList(CarRepository $carRepository): Response
{
    // Récupérer la liste des voitures depuis le repository
    $cars = $carRepository->findAll();

    // Passer la liste des voitures à la vue
    return $this->render('car/cars_list.html.twig', [
        'cars' => $cars,
    ]);
}

}
