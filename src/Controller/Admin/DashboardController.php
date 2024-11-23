<?php

namespace App\Controller\Admin;

use App\Entity\Animals;
use App\Entity\Habitats;
use App\Entity\Reviews;
use App\Entity\Services;
use App\Entity\User;
use App\Entity\VetVisit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zoo Arcadia');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Habitats', 'fas fa-image', Habitats::class);
        yield MenuItem::linkToCrud('Animaux', 'fas fa-paw', Animals::class);
        yield MenuItem::linkToCrud('Visites vétérinaires', 'fa-solid fa-stethoscope', VetVisit::class);
        yield MenuItem::linkToCrud('Services', 'fa fa-calendar-check', Services::class);
        yield MenuItem::linkToCrud('Avis', 'fa-regular fa-star', Reviews::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-users', User::class);
    }
}
