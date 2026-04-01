<?php

// tests/Unit/Entity/UserTest.php
namespace App\Tests\Unit\Entity;

use App\Entity\User;
use App\Entity\Reviews;
use App\Entity\Animals;
use App\Entity\Services;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    // Test 1 : ROLE_USER est toujours garanti
    public function testGetRolesAlwaysContainsRoleUser(): void
    {
        $user = new User();
        $user->setRoles([]); // aucun rôle défini

        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    // Test 2 : Les rôles sont dédoublonnés
    public function testGetRolesAreUnique(): void
    {
        $user = new User();
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);

        $roles = $user->getRoles();

        // ROLE_USER ne doit apparaître qu'une seule fois
        $this->assertCount(
            count(array_unique($roles)),
            $roles
        );
    }

    // Test 3 : Admin possède bien son rôle
    public function testAdminRole(): void
    {
        $user = new User();
        $user->setRoles(['ROLE_ADMIN']);

        $this->assertContains('ROLE_ADMIN', $user->getRoles());
        $this->assertContains('ROLE_USER', $user->getRoles()); // toujours présent
    }

    // Test 4 : getUserIdentifier retourne l'email
    public function testGetUserIdentifierReturnsEmail(): void
    {
        $user = new User();
        $user->setEmail('vet@arcadia.fr');

        $this->assertSame('vet@arcadia.fr', $user->getUserIdentifier());
    }

    // Test 5 : __toString retourne l'email
    public function testToStringReturnsEmail(): void
    {
        $user = new User();
        $user->setEmail('admin@arcadia.fr');

        $this->assertSame('admin@arcadia.fr', (string) $user);
    }

    // Test 6 : addReview évite les doublons
    public function testAddReviewNoDuplicate(): void
    {
        $user = new User();
        $review = new Reviews();

        $user->addReview($review);
        $user->addReview($review); // ajout en double

        $this->assertCount(1, $user->getReviews());
    }

    // Test 7 : removeReview fonctionne
    public function testRemoveReview(): void
    {
        $user = new User();
        $review = new Reviews();

        $user->addReview($review);
        $user->removeReview($review);

        $this->assertCount(0, $user->getReviews());
    }
}