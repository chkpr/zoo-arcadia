<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Reviews;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ReviewsTest extends TestCase
{
    // Test 1 : __toString retourne le contenu
    public function testToStringReturnsContent(): void
    {
        $review = new Reviews();
        $review->setContent('Magnifique zoo, les enfants ont adoré !');

        $this->assertSame('Magnifique zoo, les enfants ont adoré !', (string) $review);
    }

    // Test 2 : auteur
    public function testSetAndGetAuthor(): void
    {
        $review = new Reviews();
        $review->setAuthor('Marie Dupont');

        $this->assertSame('Marie Dupont', $review->getAuthor());
    }

    // Test 3 : contenu
    public function testSetAndGetContent(): void
    {
        $review = new Reviews();
        $review->setContent('Très beau zoo, bien entretenu.');

        $this->assertSame('Très beau zoo, bien entretenu.', $review->getContent());
    }

    // Test 4 : note (rate)
    public function testSetAndGetRate(): void
    {
        $review = new Reviews();
        $review->setRate(5);

        $this->assertSame(5, $review->getRate());
    }

    // Test 5 : avis en attente de modération (status = false)
    public function testReviewIsPendingByDefault(): void
    {
        $review = new Reviews();
        $review->setStatus(false);

        $this->assertFalse($review->isStatus());
    }

    // Test 6 : avis approuvé après modération (status = true)
    public function testReviewCanBeApproved(): void
    {
        $review = new Reviews();
        $review->setStatus(true);

        $this->assertTrue($review->isStatus());
    }

    // Test 7 : association avec un utilisateur
    public function testSetAndGetUser(): void
    {
        $review = new Reviews();
        $user = new User();
        $user->setEmail('visiteur@arcadia.fr');

        $review->setUser($user);

        $this->assertSame($user, $review->getUser());
        $this->assertSame('visiteur@arcadia.fr', $review->getUser()->getEmail());
    }

    // Test 8 : l'utilisateur peut être dissocié (null)
    public function testUserCanBeNull(): void
    {
        $review = new Reviews();
        $review->setUser(null);

        $this->assertNull($review->getUser());
    }

    // Test 9 : scénario complet — avis modéré et publié
    public function testCompleteApprovedReview(): void
    {
        $user = new User();
        $user->setEmail('famille@arcadia.fr');

        $review = new Reviews();
        $review->setAuthor('Famille Martin')
               ->setContent('Une journée inoubliable, bravo à toute l\'équipe !')
               ->setRate(5)
               ->setStatus(true)
               ->setUser($user);

        $this->assertSame('Famille Martin', $review->getAuthor());
        $this->assertSame(5, $review->getRate());
        $this->assertTrue($review->isStatus());
        $this->assertSame('famille@arcadia.fr', $review->getUser()->getEmail());
    }

    // Test 10 : scénario — avis négatif en attente de modération
    public function testNegativeReviewPending(): void
    {
        $review = new Reviews();
        $review->setAuthor('Client mécontent')
               ->setContent('Trop cher et peu d\'animaux visibles.')
               ->setRate(2)
               ->setStatus(false);

        $this->assertSame(2, $review->getRate());
        $this->assertFalse($review->isStatus());
    }
}