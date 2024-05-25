<?php

namespace App\Entity;

use App\Repository\AlimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlimentRepository::class)]
class Aliment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeAliment = null;

    #[ORM\OneToMany(mappedBy: 'Aliments', targetEntity: Ration::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $rations;

    public function __construct()
    {
        $this->rations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeAliment(): ?string
    {
        return $this->typeAliment;
    }

    public function setTypeAliment(string $typeAliment): static
    {
        $this->typeAliment = $typeAliment;

        return $this;
    }

    /**
     * @return Collection<int, Ration>
     */
    public function getRations(): Collection
    {
        return $this->rations;
    }

    public function addRation(Ration $ration): static
    {
        if (!$this->rations->contains($ration)) {
            $this->rations->add($ration);
            $ration->setAliments($this);
        }

        return $this;
    }

    public function removeRation(Ration $ration): static
    {
        if ($this->rations->removeElement($ration)) {
            // set the owning side to null (unless already changed)
            if ($ration->getAliments() === $this) {
                $ration->setAliments(null);
            }
        }

        return $this;
    }
}
