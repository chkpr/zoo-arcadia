<?php

namespace App\Entity;

use App\Repository\AnimalsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalsRepository::class)]
class Animals
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $Species = null;

    #[ORM\Column(length: 255)]
    private ?string $latin = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Habitats $habitat = null;

    /**
     * @var Collection<int, VetVisit>
     */
    #[ORM\OneToMany(targetEntity: VetVisit::class, mappedBy: 'animal')]
    private Collection $vetVisits;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'animals')]
    private Collection $user;

    public function __construct()
    {
        $this->vetVisits = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSpecies(): ?string
    {
        return $this->Species;
    }

    public function setSpecies(string $Species): static
    {
        $this->Species = $Species;

        return $this;
    }

    public function getLatin(): ?string
    {
        return $this->latin;
    }

    public function setLatin(string $latin): static
    {
        $this->latin = $latin;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getHabitat(): ?Habitats
    {
        return $this->habitat;
    }

    public function setHabitat(?Habitats $habitat): static
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * @return Collection<int, VetVisit>
     */
    public function getVetVisits(): Collection
    {
        return $this->vetVisits;
    }

    public function addVetVisit(VetVisit $vetVisit): static
    {
        if (!$this->vetVisits->contains($vetVisit)) {
            $this->vetVisits->add($vetVisit);
            $vetVisit->setAnimal($this);
        }

        return $this;
    }

    public function removeVetVisit(VetVisit $vetVisit): static
    {
        if ($this->vetVisits->removeElement($vetVisit)) {
            // set the owning side to null (unless already changed)
            if ($vetVisit->getAnimal() === $this) {
                $vetVisit->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->user->removeElement($user);

        return $this;
    }
}
