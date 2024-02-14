<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\CarContactType;
use App\Form\ContactType;
use App\Repository\CarRepository;
use App\Repository\OpeningDayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mime\Email;

class CarController extends AbstractController
{
    #[Route('/car/{slug}', name: 'car_detail')]
public function carDetail(string $slug, CarRepository $carRepository, OpeningDayRepository $openingDayRepository, Request $request, MailerInterface $mailer, SessionInterface $session, EntityManagerInterface $entityManager): Response
{
    // Récupérer la voiture par le slug depuis le repository
    $car = $carRepository->findOneBy(['slug' => $slug]);
    $openingDays = $openingDayRepository->findAll();

    // Vérifier si la voiture existe
    if (!$car) {
        throw $this->createNotFoundException('Car not found');
    }


    $form = $this->createForm(CarContactType::class, null, [
        'car_name' => $car->getName(),
        'car_price' => $car->getPrice(),
        'car_id' => $car->getId(),
    ]);

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
        $contact->setCarId($car->getId());
        $contact->setCarName($car->getName());
        $contact->setCarPrice($car->getPrice());

        $entityManager->persist($contact);
        $entityManager->flush();

        // Send email
        $address = $data->getEmail();
        $content = $data->getContent();
        $subject = $car->getName() . "/" . $car->getPrice();

        $email = (new Email())
            ->from($address)
            ->to('zaki.tehami@gmail.com')
            ->subject($subject)
            ->text($content);

        $mailer->send($email);

        $session->getFlashBag()->add('success', 'Votre message a été envoyé avec succès.');
    }





    // Passer la voiture à la vue
    return $this->render('car/carDetail.html.twig', [
        'car' => $car,
        'openingDays' => $openingDays,
        'formulaire' => $form->createView(),
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

#[Route('/cars/filtered', name: 'filtered_cars_list')]
public function filteredCarsList(Request $request, CarRepository $carRepository, OpeningDayRepository $openingDayRepository): Response
{
    $filters = $request->request->all();

    // Add your filtering logic using $filters
    $filteredCars = $carRepository->findByFilters($filters);
    $openingDays = $openingDayRepository->findAll();

    // Render the filtered car list
    return $this->render('car/filtered_cars_list.html.twig', [
        'cars' => $filteredCars,
        'openingDays' => $openingDays,
    ]);
}

}
