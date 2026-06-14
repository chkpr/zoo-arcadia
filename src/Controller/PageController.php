<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Repository\HabitatsRepository;
use App\Repository\ReviewsRepository;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ContactType;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HabitatsRepository $habitatsRepository, ServicesRepository $servicesRepository, ReviewsRepository $reviewsRepository): Response
    {
        $habitats = $habitatsRepository->findBy([], ['id' => 'ASC'],3);

        $services = $servicesRepository->findBy([], ['id' => 'ASC'],3);

        $reviews = $reviewsRepository->findBy(['status' => 'true'], ['id' => 'DESC'],3);

        $websiteName = 'Zoo Arcadia';

        $contactForm = $this->createForm(ContactType::class);

        return $this->render('page/index.html.twig', [
            'websiteName' => $websiteName,
            'habitats' => $habitats,
            'services' => $services,
            'reviews' => $reviews,
            'contactForm' => $contactForm,

        ]);
    }

   

    

}
