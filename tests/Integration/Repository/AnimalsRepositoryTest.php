<?php
// tests/Integration/Repository/AnimalsRepositoryTest.php

namespace App\Tests\Integration\Repository;

use App\Entity\Animals;
use App\Entity\Habitats;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AnimalsRepositoryTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    // Test 1 : récupérer tous les animaux
    public function testFindAllAnimals(): void
    {
        $animals = $this->entityManager
            ->getRepository(Animals::class)
            ->findAll();

        $this->assertNotEmpty($animals);
        $this->assertInstanceOf(Animals::class, $animals[0]);
    }

    // Test 2 : trouver un animal par son nom
    public function testFindAnimalByName(): void
    {
        $animal = $this->entityManager
            ->getRepository(Animals::class)
            ->findOneBy(['name' => 'Lion']);

        $this->assertNotNull($animal);
        $this->assertSame('Panthera leo', $animal->getLatin());
    }

    // Test 3 : trouver les animaux d'un habitat
    public function testFindAnimalsByHabitat(): void
    {
        $habitat = $this->entityManager
            ->getRepository(Habitats::class)
            ->findOneBy(['name' => 'Savane']);

        $this->assertNotNull($habitat);

        $animals = $this->entityManager
            ->getRepository(Animals::class)
            ->findBy(['habitat' => $habitat]);

        $this->assertNotEmpty($animals);
        $this->assertSame('Lion', $animals[0]->getName());
    }

    // Test 4 : persister un nouvel animal
    public function testPersistNewAnimal(): void
    {
        $habitat = $this->entityManager
            ->getRepository(Habitats::class)
            ->findOneBy(['name' => 'Savane']);

        $animal = new Animals();
        $animal->setName('Girafe');
        $animal->setSpecies('Mammifère');
        $animal->setLatin('Giraffa camelopardalis');
        $animal->setDescription('Le plus grand animal terrestre.');
        $animal->setHabitat($habitat);

        $this->entityManager->persist($animal);
        $this->entityManager->flush();

        $this->assertNotNull($animal->getId());
    }

    // Test 5 : modifier la description d'un animal
    public function testUpdateAnimalDescription(): void
    {
        $animal = $this->entityManager
            ->getRepository(Animals::class)
            ->findOneBy(['name' => 'Lion']);

        $animal->setDescription('Le lion, roi incontesté de la savane africaine.');
        $this->entityManager->flush();

        $updated = $this->entityManager
            ->getRepository(Animals::class)
            ->findOneBy(['name' => 'Lion']);

        $this->assertSame(
            'Le lion, roi incontesté de la savane africaine.',
            $updated->getDescription()
        );
    }

    // Test 6 : supprimer un animal
    public function testDeleteAnimal(): void
    {
        $animal = $this->entityManager
            ->getRepository(Animals::class)
            ->findOneBy(['name' => 'Girafe']);

        $this->assertNotNull($animal);

        $this->entityManager->remove($animal);
        $this->entityManager->flush();

        $deleted = $this->entityManager
            ->getRepository(Animals::class)
            ->findOneBy(['name' => 'Girafe']);

        $this->assertNull($deleted);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}