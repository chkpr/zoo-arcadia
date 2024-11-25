<?php

namespace App\Controller;

use App\Repository\HabitatsRepository;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HabitatsRepository $habitatsRepository, ServicesRepository $servicesRepository): Response
    {
        $habitats = $habitatsRepository->findBy([], ['id' => 'ASC'],3);

        $services = $servicesRepository->findBy([], ['id' => 'ASC'],3);

        $websiteName = 'Zoo Arcadia';
        return $this->render('page/index.html.twig', [
            'websiteName' => $websiteName,
            'habitats' => $habitats,
            'services' => $services,

        ]);
    }
}
