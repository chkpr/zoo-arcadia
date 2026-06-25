<?php

namespace App\Entity;

use App\Repository\HabitatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: HabitatsRepository::class)]
#[Vich\Uploadable]
class Habitats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    /**
     * @var Collection<int, Animals>
     */
    #[ORM\OneToMany(targetEntity: Animals::class, mappedBy: 'habitat')]
    private Collection $animals;

    #[Vich\UploadableField(mapping: 'habitat', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;
    
    #[ORM\Column(length: 255)]
    private ?string $shortDesc = null;

    #[ORM\Column(type: 'text', nullable:true, name: 'long_desc')]
    private ?string $longDesc = null;

    #[ORM\Column(type: 'string', nullable: true, name: 'long_desc_img')]
    private ?string $longDescImg = null;

    #[ORM\Column(type: 'string', nullable: true, name: 'habitat_presentation_subtitle')]
    private ?string $habitatPresentationSubtitle = null;

#[Vich\UploadableField(mapping: 'habitat', fileNameProperty: 'longDescImg')]
private ?File $longDescImgFile = null;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection<int, Animals>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animals $animal): static
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->setHabitat($this);
        }

        return $this;
    }

    public function removeAnimal(Animals $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getHabitat() === $this) {
                $animal->setHabitat(null);
            }
        }

        return $this;
    }

        /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getShortDesc(): ?string
    {
        return $this->shortDesc;
    }

    public function setShortDesc(string $shortDesc): static
    {
        $this->shortDesc = $shortDesc;

        return $this;
    }

    public function getLongDesc(): ?string
    {
        return $this->longDesc;
    }

    public function setLongDesc(string $longDesc): static
    {
        $this->longDesc = $longDesc;

        return $this;
    }

    public function getLongDescImg(): ?string
{
    return $this->longDescImg;
}

public function setLongDescImg(?string $longDescImg): static
{
    $this->longDescImg = $longDescImg;
    return $this;
}

public function getLongDescImgFile(): ?File
{
    return $this->longDescImgFile;
}

public function setLongDescImgFile(?File $longDescImgFile): static
{
    $this->longDescImgFile = $longDescImgFile;
    if ($longDescImgFile !== null) {
        $this->updatedAt = new \DateTimeImmutable();
    }
    return $this;
}

    public function getHabitatPresentationSubtitle(): ?string
    {
        return $this->habitatPresentationSubtitle;
    }

    public function setHabitatPresentationSubtitle(string $habitatPresentationSubtitle): static
    {
        $this->habitatPresentationSubtitle = $habitatPresentationSubtitle;

        return $this;
    }

}
