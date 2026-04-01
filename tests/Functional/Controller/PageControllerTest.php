<?php
// tests/Functional/Controller/PageControllerTest.php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    // Test 1 : page d'accueil accessible
    public function testHomePageIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    // Test 2 : page des habitats accessible
    public function testHabitatsPageIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/habitats');

        $this->assertResponseIsSuccessful();
    }

    // Test 3 : page des animaux accessible
    public function testAnimalsPageIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/animals');

        $this->assertResponseIsSuccessful();
    }

    // Test 4 : page des services accessible
    public function testServicesPageIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/services');

        $this->assertResponseIsSuccessful();
    }

    // Test 5 : page des avis accessible
    public function testReviewsPageIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/avis');

        $this->assertResponseIsSuccessful();
    }

    // Test 6 : page contact accessible
    public function testContactPageIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/contact');

        $this->assertResponseIsSuccessful();
    }

    // Test 7 : page d'un habitat inexistant → 404
    public function testHabitatNotFoundReturns404(): void
    {
        $client = static::createClient();
        $client->request('GET', '/habitats/99999');

        $this->assertResponseStatusCodeSame(404);
    }

    // Test 8 : page d'un animal inexistant → 404
    public function testAnimalNotFoundReturns404(): void
    {
        $client = static::createClient();
        $client->request('GET', '/animals/99999');

        $this->assertResponseStatusCodeSame(404);
    }
}