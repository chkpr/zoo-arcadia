<?php

namespace App\Controller;

use App\Entity\Animals;
use App\Repository\AnimalsRepository;
use App\Repository\HabitatsRepository;
use App\Document\AnimalStats;
use Doctrine\ODM\MongoDB\DocumentManager;
use MongoDB\BSON\Regex;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

class AnimalsController extends AbstractController
{
    private DocumentManager $dm;
    private LoggerInterface $logger;

    public function __construct(DocumentManager $dm, LoggerInterface $logger)
    {
        $this->dm = $dm;
        $this->logger = $logger;
    }

    #[Route('/animals', name: 'app_animals')]
    public function index(AnimalsRepository $animalsRepository): Response
    {
        $animals = $animalsRepository->findBy([], ['id' => 'ASC']);
        return $this->render('animals/index.html.twig', [
            'animals' => $animals,
        ]);
    }

       
    #[Route('/animals/{id}', name: 'app_animals_show', methods: ['GET'])]
   
    public function show(#[MapEntity(id: 'id')] Animals $animal, int $id): Response
    {
        $animalId = $id;

        $updateViews = $this->dm->createQueryBuilder(AnimalStats::class)
           ->findAndUpdate()
           -> upsert(true)
           ->field('animal_id')->equals($animalId)
           ->field('views')->inc(1)        
            ->getQuery()
          ->execute();

        return $this->render('./partials/_page.animal.html.twig', [
            'animal' => $animal,
        ]);
    }
    }







