<?php

namespace App\Entity;

use App\Repository\VeterinaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VeterinaireRepository::class)]
class Veterinaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomVeterinaire = null;

    #[ORM\ManyToOne(inversedBy: 'Veterinaires')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Traitement $traitement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVeterinaire(): ?string
    {
        return $this->nomVeterinaire;
    }

    public function setNomVeterinaire(string $nomVeterinaire): static
    {
        $this->nomVeterinaire = $nomVeterinaire;

        return $this;
    }

    public function getTraitement(): ?Traitement
    {
        return $this->traitement;
    }

    public function setTraitement(?Traitement $traitement): static
    {
        $this->traitement = $traitement;

        return $this;
    }
}
