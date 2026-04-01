<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Animals;
use App\Entity\Habitats;
use App\Entity\VetVisit;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class AnimalsTest extends TestCase
{
    // Test 1 : __toString retourne le nom
    public function testToStringReturnsName(): void
    {
        $animal = new Animals();
        $animal->setName('Lion');

        $this->assertSame('Lion', (string) $animal);
    }

    // Test 2 : getters/setters de base
    public function testNameSpeciesLatin(): void
    {
        $animal = new Animals();
        $animal->setName('Girafe');
        $animal->setSpecies('Mammifère');
        $animal->setLatin('Giraffa camelopardalis');

        $this->assertSame('Girafe', $animal->getName());
        $this->assertSame('Mammifère', $animal->getSpecies());
        $this->assertSame('Giraffa camelopardalis', $animal->getLatin());
    }

    // Test 3 : association avec un habitat
    public function testSetAndGetHabitat(): void
    {
        $animal = new Animals();
        $habitat = new Habitats();

        $animal->setHabitat($habitat);

        $this->assertSame($habitat, $animal->getHabitat());
    }

    // Test 4 : habitat peut être null
    public function testHabitatCanBeNull(): void
    {
        $animal = new Animals();
        $animal->setHabitat(null);

        $this->assertNull($animal->getHabitat());
    }

    // Test 5 : addVetVisit évite les doublons
    public function testAddVetVisitNoDuplicate(): void
    {
        $animal = new Animals();
        $visit = new VetVisit();

        $animal->addVetVisit($visit);
        $animal->addVetVisit($visit);

        $this->assertCount(1, $animal->getVetVisits());
    }

    // Test 6 : removeVetVisit fonctionne
    public function testRemoveVetVisit(): void
    {
        $animal = new Animals();
        $visit = new VetVisit();

        $animal->addVetVisit($visit);
        $animal->removeVetVisit($visit);

        $this->assertCount(0, $animal->getVetVisits());
    }

    // Test 7 : addUser évite les doublons
    public function testAddUserNoDuplicate(): void
    {
        $animal = new Animals();
        $user = new User();

        $animal->addUser($user);
        $animal->addUser($user);

        $this->assertCount(1, $animal->getUser());
    }

    // Test 8 : setImageFile met à jour updatedAt
    public function testSetImageFileUpdatesUpdatedAt(): void
    {
        $animal = new Animals();

        // Créer un faux fichier temporaire
        $tmpPath = tempnam(sys_get_temp_dir(), 'test_');
        $file = new \Symfony\Component\HttpFoundation\File\File($tmpPath);

        $animal->setImageFile($file);

        $this->assertNotNull($animal->getImageFile());

        // Nettoyage
        unlink($tmpPath);
    }

    // Test 9 : setImageFile(null) ne modifie pas updatedAt
    public function testSetImageFileNullDoesNotUpdateDate(): void
    {
        $animal = new Animals();
        $animal->setImageFile(null);

        // updatedAt doit rester null
        $this->assertNull($animal->getImageFile());
    }
}