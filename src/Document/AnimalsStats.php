<?php

declare(strict_types=1);

namespace App\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[ODM\Document(collection: 'animals')]
class AnimalStats
{
    #[ODM\Id]
    public ?string $id = null;

    #[ODM\Field]
    public string $animal_id;

    #[ODM\Field]
    public string $animal;

    #[ODM\Field]
    public string $name;

     #[ODM\Field]
    public string $views;
}
