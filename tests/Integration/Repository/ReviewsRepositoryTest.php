<?php
// tests/Integration/Repository/ReviewsRepositoryTest.php

namespace App\Tests\Integration\Repository;

use App\Entity\Reviews;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ReviewsRepositoryTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    // Test 1 : récupérer tous les avis
    public function testFindAllReviews(): void
    {
        $reviews = $this->entityManager
            ->getRepository(Reviews::class)
            ->findAll();

        $this->assertNotEmpty($reviews);
        $this->assertInstanceOf(Reviews::class, $reviews[0]);
    }

    // Test 2 : trouver les avis en attente de modération
    public function testFindPendingReviews(): void
    {
        $pending = $this->entityManager
            ->getRepository(Reviews::class)
            ->findBy(['status' => false]);

        $this->assertNotEmpty($pending);
        foreach ($pending as $review) {
            $this->assertFalse($review->isStatus());
        }
    }

    // Test 3 : approuver un avis (modération)
    public function testApproveReview(): void
    {
        $review = $this->entityManager
            ->getRepository(Reviews::class)
            ->findOneBy(['status' => false]);

        $this->assertNotNull($review);

        $review->setStatus(true);
        $this->entityManager->flush();

        $approved = $this->entityManager
            ->getRepository(Reviews::class)
            ->findOneBy(['author' => $review->getAuthor()]);

        $this->assertTrue($approved->isStatus());
    }

    // Test 4 : persister un nouvel avis
    public function testPersistNewReview(): void
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'employe@arcadia.fr']);

        $review = new Reviews();
        $review->setAuthor('Jean Martin');
        $review->setContent('Très belle expérience, je recommande !');
        $review->setRate(4);
        $review->setStatus(false);
        $review->setUser($user);

        $this->entityManager->persist($review);
        $this->entityManager->flush();

        $this->assertNotNull($review->getId());
    }

    // Test 5 : trouver les avis d'un utilisateur
    public function testFindReviewsByUser(): void
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'employe@arcadia.fr']);

        $this->assertNotNull($user);

        $reviews = $this->entityManager
            ->getRepository(Reviews::class)
            ->findBy(['user' => $user]);

        $this->assertNotEmpty($reviews);
        $this->assertSame('employe@arcadia.fr', $reviews[0]->getUser()->getEmail());
    }

    // Test 6 : supprimer un avis
    public function testDeleteReview(): void
    {
        $review = $this->entityManager
            ->getRepository(Reviews::class)
            ->findOneBy(['author' => 'Jean Martin']);

        $this->assertNotNull($review);

        $this->entityManager->remove($review);
        $this->entityManager->flush();

        $deleted = $this->entityManager
            ->getRepository(Reviews::class)
            ->findOneBy(['author' => 'Jean Martin']);

        $this->assertNull($deleted);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}