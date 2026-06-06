<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Form\ReviewType;
use App\Form\ValidateReviewType;
use App\Repository\ReviewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReviewsController extends AbstractController
{
    #[Route('/avis', name: 'app_reviews')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {   
        $review = new Reviews();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($review);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('app_reviews_sent', [
            ]);
        } else { return $this->render('reviews/index.html.twig', [
            'form' => $form,
        ]);
        }
    }

    #[Route('/avis/sent', name: 'app_reviews_sent')]
        public function show(): Response
        {

            $review = new Reviews();
        $form = $this->createForm(ReviewType::class, $review);
        
            return $this->render('reviews/sent.html.twig', [
                'form' =>$form,
            ]);
        }
}
