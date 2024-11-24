<?php

namespace App\Controller;

use App\Repository\HabitatsRepository;
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
}
