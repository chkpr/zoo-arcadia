<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\AnimalsRepository;
use App\Document\AnimalStats;
use App\Entity\Animals;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use MongoDB\BSON\Regex;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalStatsController extends AbstractController
{
    private DocumentManager $dm;
    private LoggerInterface $logger;
    private AnimalsRepository $animalsRepository;

    public function __construct(DocumentManager $dm, LoggerInterface $logger, AnimalsRepository $animalsRepository)
    {
        $this->dm = $dm;
        $this->logger = $logger;
        $this->animalsRepository = $animalsRepository;
    }

    #[Route('/animalstats', name: 'animalstats_index', methods: ['GET'])]
    public function index(Request $request): Response
    {   

        return $this->render('animalstats/index.html.twig');


    }

    #[Route('/animalstats/show', name: 'animalstats_show', methods: ['GET'])]
    public function browse(Request $request): Response
    {
        $animalstatsRepository = $this->dm->getRepository(AnimalStats::class);
        $queryBuilder = $animalstatsRepository->createQueryBuilder();


        $animalstats = $queryBuilder
                ->getQuery()
                ->execute()
                ->toArray();

        $result = [];
        foreach ($animalstats as $stat) {
            $animal = $this->animalsRepository->find($stat->getAnimal_id());
            $result[] = [
                'views' => $stat->getViews(),
                'name' => $animal ? $animal->getName() : 'Inconnu',
                'species' => $animal ? $animal->getSpecies() : 'Inconnue',
                'animal_id' => $stat->getAnimal_id(),
            ];
        }  

        return $this->render('animalstats/show.html.twig', ['animalstats' => $result]);
    }
}
