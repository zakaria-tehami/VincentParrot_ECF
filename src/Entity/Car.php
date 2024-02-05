<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    #[ORM\Column(length: 255)]
    private ?string $year = null;

    #[ORM\Column(length: 255)]
    private ?string $kilometer = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $caracteristics = null;

    #[ORM\Column(length: 255)]
    private ?string $energy = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'car')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: CarImage::class)]
    private Collection $carImage;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Contact $contact = null;

    public function __construct()
    {
        $this->carImage = new ArrayCollection();
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getKilometer(): ?string
    {
        return $this->kilometer;
    }

    public function setKilometer(string $kilometer): static
    {
        $this->kilometer = $kilometer;

        return $this;
    }

    public function getCaracteristics(): ?string
    {
        return $this->caracteristics;
    }

    public function setCaracteristics(string $caracteristics): static
    {
        $this->caracteristics = $caracteristics;

        return $this;
    }

    public function getEnergy(): ?string
    {
        return $this->energy;
    }

    public function setEnergy(string $energy): static
    {
        $this->energy = $energy;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CarImage>
     */
    public function getCarImage(): Collection
    {
        return $this->carImage;
    }

    public function addCarImage(CarImage $carImage): static
    {
        if (!$this->carImage->contains($carImage)) {
            $this->carImage->add($carImage);
            $carImage->setCar($this);
        }

        return $this;
    }

    public function removeCarImage(CarImage $carImage): static
    {
        if ($this->carImage->removeElement($carImage)) {
            // set the owning side to null (unless already changed)
            if ($carImage->getCar() === $this) {
                $carImage->setCar(null);
            }
        }

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): static
    {
        $this->contact = $contact;

        return $this;
    }
    public function __toString(): string
    {
        return $this->name . "(" . $this->id .  ")";
    }
}
