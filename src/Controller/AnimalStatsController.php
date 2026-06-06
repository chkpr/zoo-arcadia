<?php

declare(strict_types=1);

namespace App\Controller;

use App\Document\AnimalStats;
use Doctrine\ODM\MongoDB\DocumentManager;
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

    public function __construct(DocumentManager $dm, LoggerInterface $logger)
    {
        $this->dm = $dm;
        $this->logger = $logger;
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
                ->field('animal_id')->equals('1')
                ->getQuery()
                ->execute();

        return $this->render('animalstats/show.html.twig', ['animalstats' => $animalstats]);
    }
}
