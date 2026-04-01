<?php
// tests/Integration/Repository/VetVisitRepositoryTest.php

namespace App\Tests\Integration\Repository;

use App\Entity\Animals;
use App\Entity\VetVisit;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VetVisitRepositoryTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    // Test 1 : récupérer toutes les visites vétérinaires
    public function testFindAllVetVisits(): void
    {
        $visits = $this->entityManager
            ->getRepository(VetVisit::class)
            ->findAll();

        $this->assertNotEmpty($visits);
        $this->assertInstanceOf(VetVisit::class, $visits[0]);
    }

    // Test 2 : trouver une visite par animal
    public function testFindVetVisitByAnimal(): void
    {
        $animal = $this->entityManager
            ->getRepository(Animals::class)
            ->findOneBy(['name' => 'Lion']);

        $this->assertNotNull($animal);

        $visits = $this->entityManager
            ->getRepository(VetVisit::class)
            ->findBy(['animal' => $animal]);

        $this->assertNotEmpty($visits);
        $this->assertSame('Bonne santé', $visits[0]->getHealth());
    }

    // Test 3 : persister une nouvelle visite vétérinaire
    public function testPersistNewVetVisit(): void
    {
        $animal = $this->entityManager
            ->getRepository(Animals::class)
            ->findOneBy(['name' => 'Lion']);

        $visit = new VetVisit();
        $visit->setDate(new \DateTime('2025-05-01'));
        $visit->setTime(new \DateTime('10:00:00'));
        $visit->setHealth('Excellent');
        $visit->setFood('Viande crue');
        $visit->setQuantity('6 kg');
        $visit->setDetails('Animal en pleine forme.');
        $visit->setAnimal($animal);

        $this->entityManager->persist($visit);
        $this->entityManager->flush();

        $this->assertNotNull($visit->getId());
    }

    // Test 4 : la visite est bien associée à son animal
    public function testVetVisitIsLinkedToAnimal(): void
    {
        $visit = $this->entityManager
            ->getRepository(VetVisit::class)
            ->findOneBy(['health' => 'Bonne santé']);

        $this->assertNotNull($visit);
        $this->assertSame('Lion', $visit->getAnimal()->getName());
    }

    // Test 5 : supprimer une visite vétérinaire
    public function testDeleteVetVisit(): void
    {
        $visit = $this->entityManager
            ->getRepository(VetVisit::class)
            ->findOneBy(['health' => 'Bonne santé']);

        $this->assertNotNull($visit);

        $this->entityManager->remove($visit);
        $this->entityManager->flush();

        $deleted = $this->entityManager
            ->getRepository(VetVisit::class)
            ->findOneBy(['health' => 'Bonne santé']);

        $this->assertNull($deleted);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}