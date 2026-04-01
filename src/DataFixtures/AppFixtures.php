<?php

namespace App\DataFixtures;

use App\Entity\Animals;
use App\Entity\Habitats;
use App\Entity\Reviews;
use App\Entity\User;
use App\Entity\VetVisit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Habitat
        $habitat = new Habitats();
        $habitat->setName('Savane');
        $habitat->setDescription('Vaste plaine ensoleillée.');
        $manager->persist($habitat);

        // Animal
        $animal = new Animals();
        $animal->setName('Lion');
        $animal->setSpecies('Mammifère');
        $animal->setLatin('Panthera leo');
        $animal->setDescription('Le roi de la savane.');
        $animal->setHabitat($habitat);
        $manager->persist($animal);

        // VetVisit
        $visit = new VetVisit();
        $visit->setDate(new \DateTime('2025-04-01'));
        $visit->setTime(new \DateTime('09:00:00'));
        $visit->setHealth('Bonne santé');
        $visit->setFood('Viande crue');
        $visit->setQuantity('5 kg');
        $visit->setDetails('RAS');
        $visit->setAnimal($animal);
        $manager->persist($visit);

        // User
        $user = new User();
        $user->setEmail('employe@arcadia.fr');
        $user->setPassword('motdepassehache');
        $user->setRoles(['ROLE_EMPLOYE']);
        $manager->persist($user);

        // Review
        $review = new Reviews();
        $review->setAuthor('Famille Durand');
        $review->setContent('Superbe visite !');
        $review->setRate(5);
        $review->setStatus(false);
        $review->setUser($user);
        $manager->persist($review);

        $manager->flush();
    }
}