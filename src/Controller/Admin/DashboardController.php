<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\CarImage;
use App\Entity\OpeningDay;
use App\Entity\Service;
use App\Entity\Testimonial;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $AdminUrlGenerator
    )
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->AdminUrlGenerator->setController(CarCrudController::class)
        ->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Vincent Parrot Garage');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::subMenu('Voitures', 'fas fa-car')->setSubItems([
            MenuItem::linkToCrud('Toutes les voitures','fas fa-car', Car::class),
            MenuItem::linkToCrud('Ajouter une voitures','fas fa-plus', Car::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::subMenu('Images', 'fas fa-photo-video')->setSubItems([
            MenuItem::linkToCrud('Médiathèque','fas fa-photo-video', CarImage::class),
            MenuItem::linkToCrud('Ajouter des images','fas fa-plus', CarImage::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::subMenu('Services', 'fas fa-gear')->setSubItems([
            MenuItem::linkToCrud('Tous les services','fas fa-gear', Service::class),
            MenuItem::linkToCrud('Ajouter un service','fas fa-plus', Service::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::subMenu('Horaires D\'ouvertures', 'fas fa-calendar-day')->setSubItems([
            MenuItem::linkToCrud('Voir les horaires','fas fa-calendar-day', OpeningDay::class),
            MenuItem::linkToCrud('Modifer','fas fa-pen', OpeningDay::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::subMenu('Commentaires', 'fas fa-comment-dots')->setSubItems([
            MenuItem::linkToCrud('Voir les Commentaires','fas fa-comment', Testimonial::class),
            MenuItem::linkToCrud('Ajouter un commentaire','fas fa-plus', Testimonial::class)->setAction(Crud::PAGE_NEW),
        ]);
        if ($this->isGranted('ROLE_ADMIN')) {
        yield MenuItem::subMenu('Comptes salariés', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Toutes les Comptes','fas fa-user-friends', User::class),
            MenuItem::linkToCrud('Ajouter un compte','fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
        ]);
    }
    
    }
}
