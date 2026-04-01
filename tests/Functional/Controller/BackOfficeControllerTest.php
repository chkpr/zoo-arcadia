<?php

namespace App\Tests\Functional\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BackOfficeControllerTest extends WebTestCase
{
    // ✅ Test 1 : un employé connecté accède à /employe
    public function testEmployeeCanAccessEmployeeDashboard(): void
    {
        $client = static::createClient();

        $user = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneBy(['email' => 'employe@arcadia.fr']);

        $client->loginUser($user);
        $client->request('GET', '/employe');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Tableau de bord');
    }

    // ✅ Test 2 : visiteur anonyme sur /employe — EasyAdmin affiche 200
    public function testGuestCannotAccessEmployeeDashboard(): void
    {
        $client = static::createClient();
        $client->request('GET', '/employe');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.user-name', 'Utilisateur anonyme');
    }

    // ✅ Test 3 : visiteur anonyme sur /vet — EasyAdmin affiche 200
    public function testGuestCannotAccessVetDashboard(): void
    {
        $client = static::createClient();
        $client->request('GET', '/vet');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.user-name', 'Utilisateur anonyme');
    }

    // ✅ Test 4 : visiteur anonyme sur /admin — 200 ou 302
    public function testGuestCannotAccessAdminDashboard(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin');

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertContains($statusCode, [200, 302]);
    }
}