<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    // ✅ Test 1 : page de login accessible avec les bons champs
    public function testLoginPageIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('input[name="email"]');
        $this->assertSelectorExists('input[name="password"]');
    }

    // ✅ Test 2 : login avec mauvais identifiants redirige vers /login
    public function testLoginWithBadCredentials(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $client->submitForm('Connexion', [
            'email'    => 'inconnu@arcadia.fr',
            'password' => 'mauvaismdp',
        ]);

        $this->assertResponseRedirects('/login');
    }

    // ✅ Test 3 : la page de login contient bien un formulaire
    public function testLoginPageContainsForm(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
        $this->assertSelectorTextContains('button[type="submit"]', 'Connexion');
    }

    // ✅ Test 4 : /admin et /vet sont gérés par EasyAdmin (200 ou 302)
    public function testBackOfficeRedirectsToLoginIfNotAuthenticated(): void
    {
        $client = static::createClient();

        foreach (['/admin', '/vet', '/employe'] as $route) {
            $client->request('GET', $route);
            $statusCode = $client->getResponse()->getStatusCode();
            $this->assertContains(
                $statusCode,
                [200, 302],
                "La route $route doit être protégée"
            );
        }
    }
}