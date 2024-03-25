<?php

namespace App\Entity;

use App\Entity\Adresse;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EmployeRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $Nom = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $Poste = null;

    // #[ORM\OneToOne(targetEntity: Adresse::class, mappedBy: "employe", cascade: ["persist"])]
    // private ?Adresse $adresse = null;

    #[ORM\OneToOne(inversedBy: 'employe')]
    #[Assert\Type(Adresse::class)]
    #[Assert\Valid]
    private ?Adresse $adresse = null;

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(?string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->Poste;
    }

    public function setPoste(?string $Poste): static
    {
        $this->Poste = $Poste;

        return $this;
    }

}
