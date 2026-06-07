<?php

namespace App\Controller;

use App\Entity\Habitats;
use App\Repository\AnimalsRepository;
use App\Repository\HabitatsRepository;
use App\Repository\ServicesRepository;
use App\Document\AnimalStats;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ODM\MongoDB\DocumentManager;

class HabitatsController extends AbstractController
{
    #[Route('/habitats', name: 'app_habitats')]
    public function index(HabitatsRepository $habitatsRepository): Response
    {
        $habitats = $habitatsRepository->findBy([], ['id' => 'ASC']);
        return $this->render('habitats/index.html.twig', [
            'habitats' => $habitats,
        ]);   
    }

    #[Route('/habitats/{id}', name: 'app_habitats_show')]
    public function show(Habitats $habitat, AnimalsRepository $animalsRepository): Response
    {
            $animals = $animalsRepository->findBy(['habitat' => $habitat]);

            return $this->render('habitats/show.html.twig', [
            'habitat' => $habitat,
            'animals' => $animals,
        ]);
    }

    
}

