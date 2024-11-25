<?php

namespace App\Controller;

use App\Entity\Habitats;
use App\Repository\AnimalsRepository;
use App\Repository\HabitatsRepository;
use ContainerBtSLouf\getVetVisitCrudControllerconfigureResponseParametersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HabitatsController extends AbstractController
{
    #[Route('/habitats', name: 'app_habitats')]
    public function index(HabitatsRepository $habitatsRepository): Response
    {
        $habitats = $habitatsRepository->findBy([], ['id' => 'ASC']);

        dump($habitats);

        return $this->render('habitats/index.html.twig', [
            'habitats' => $habitats,
        ]);
        
    }



    #[Route('/habitats/{id}', name: 'app_habitats_show')]
    public function show(Habitats $habitat, AnimalsRepository $animalsRepository): Response
    {

            $animals = $animalsRepository->findBy(['habitat' => $habitat]);
            dump($animals);

            return $this->render('habitats/show.html.twig', [
            'habitat' => $habitat,
            'animals' => $animals,
        ]);
    }
}

