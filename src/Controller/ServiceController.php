<?php

namespace App\Controller;

use App\Entity\Services;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ServiceController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function index(ServicesRepository $servicesRepository): Response
    {
        $services = $servicesRepository->findBy([], ['id' => 'ASC']);

        return $this->render('service/index.html.twig', [
            'services' => $services,
        ]);
    }

    #[Route('/services/{id}', name: 'app_services_show')]
    public function show(Services $service): Response
    {

        dump($service);

        return $this->render('service/show.html.twig', [
            'service' => $service,
        ]);
    }
}

