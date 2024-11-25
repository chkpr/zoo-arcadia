<?php

namespace App\Controller;

use App\Entity\Animals;
use App\Repository\AnimalsRepository;
use App\Repository\HabitatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnimalsController extends AbstractController
{
    #[Route('/animals', name: 'app_animals')]
    public function index(AnimalsRepository $animalsRepository): Response
    {
        $animals = $animalsRepository->findBy([], ['id' => 'ASC']);

        dump($animals);

        return $this->render('animals/index.html.twig', [
            'animals' => $animals,
        ]);
    }

    #[Route('/animals/{id}', name: 'app_animals_show')]
    public function show(Animals $animal): Response
    {

        dump($animal);

        return $this->render('./partials/_page.animal.html.twig', [
            'animal' => $animal,
        ]);
    }





}
