<?php

namespace App\Tests\Unit\Entity;

use App\Entity\VetVisit;
use App\Entity\Animals;
use PHPUnit\Framework\TestCase;

class VetVisitTest extends TestCase
{
    // Test 1 : date de visite
    public function testSetAndGetDate(): void
    {
        $visit = new VetVisit();
        $date = new \DateTime('2025-03-15');

        $visit->setDate($date);

        $this->assertSame($date, $visit->getDate());
    }

    // Test 2 : heure de visite
    public function testSetAndGetTime(): void
    {
        $visit = new VetVisit();
        $time = new \DateTime('09:30:00');

        $visit->setTime($time);

        $this->assertSame($time, $visit->getTime());
    }

    // Test 3 : état de santé
    public function testSetAndGetHealth(): void
    {
        $visit = new VetVisit();
        $visit->setHealth('Bonne santé');

        $this->assertSame('Bonne santé', $visit->getHealth());
    }

    // Test 4 : nourriture donnée
    public function testSetAndGetFood(): void
    {
        $visit = new VetVisit();
        $visit->setFood('Viande crue');

        $this->assertSame('Viande crue', $visit->getFood());
    }

    // Test 5 : quantité de nourriture
    public function testSetAndGetQuantity(): void
    {
        $visit = new VetVisit();
        $visit->setQuantity('5 kg');

        $this->assertSame('5 kg', $visit->getQuantity());
    }

    // Test 6 : détails sont optionnels (nullable)
    public function testDetailsCanBeNull(): void
    {
        $visit = new VetVisit();

        $this->assertNull($visit->getDetails());
    }

    // Test 7 : détails peuvent être renseignés
    public function testSetAndGetDetails(): void
    {
        $visit = new VetVisit();
        $visit->setDetails('Animal légèrement fiévreux, surveiller.');

        $this->assertSame(
            'Animal légèrement fiévreux, surveiller.',
            $visit->getDetails()
        );
    }

    // Test 8 : association avec un animal
    public function testSetAndGetAnimal(): void
    {
        $visit = new VetVisit();
        $animal = new Animals();
        $animal->setName('Tigre');

        $visit->setAnimal($animal);

        $this->assertSame($animal, $visit->getAnimal());
        $this->assertSame('Tigre', $visit->getAnimal()->getName());
    }

    // Test 9 : l'animal peut être dissocié (null)
    public function testAnimalCanBeNull(): void
    {
        $visit = new VetVisit();
        $visit->setAnimal(null);

        $this->assertNull($visit->getAnimal());
    }

    // Test 10 : une fiche complète de visite vétérinaire
    public function testCompleteVetVisit(): void
    {
        $animal = new Animals();
        $animal->setName('Éléphant');

        $visit = new VetVisit();
        $visit->setDate(new \DateTime('2025-04-01'))
              ->setTime(new \DateTime('08:00:00'))
              ->setHealth('Excellent')
              ->setFood('Fruits et légumes')
              ->setQuantity('20 kg')
              ->setDetails('RAS, animal en pleine forme.')
              ->setAnimal($animal);

        $this->assertSame('Éléphant', $visit->getAnimal()->getName());
        $this->assertSame('Excellent', $visit->getHealth());
        $this->assertSame('20 kg', $visit->getQuantity());
        $this->assertNotNull($visit->getDetails());
    }
}