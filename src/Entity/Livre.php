<?php

namespace App\Entity;

use App\Entity\Auteur;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreRepository;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\Column(type: Types::TEXT, nullable: true)]
    // #[Assert\Type(type: "App\Entity\Auteur")]
    // #[Assert\Valid]
    // private ?string $auteur = null;

    // #[ORM\ManyToOne(targetEntity:"App\Entity\Auteur", inversedBy: "livres")]
    // #[Assert\Type(type:"App\Entity\Auteur")]
    // #[Assert\Valid]
    // private ?Auteur $auteur = null;
    // private $auteur;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[Assert\Type(Auteur::class)]
    #[Assert\Valid]
    private ?Auteur $auteur = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $annee = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $titre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }
    // public function getAuteur(): ?string
    // {
    //     return $this->auteur;
    // }

    // public function setAuteur(?string $auteur): static
    // {
    //     $this->auteur = $auteur;

    //     return $this;
    // }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(?\DateTimeInterface $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }
}
