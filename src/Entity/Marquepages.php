<?php

namespace App\Entity;

use App\Repository\MarquepagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarquepagesRepository::class)]
class Marquepages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datecreation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $motscles = null;

    #[ORM\ManyToMany(targetEntity: Motcles::class, mappedBy: 'marquepages')]
    private Collection $idmotcles;

    public function __construct()
    {
        $this->idmotcles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(?\DateTimeInterface $datecreation): static
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getMotscles(): ?string
    {
        return $this->motscles;
    }

    public function setMotscles(?string $motscles): static
    {
        $this->motscles = $motscles;

        return $this;
    }

    /**
     * @return Collection<int, Motcles>
     */
    public function getIdmotcles(): Collection
    {
        return $this->idmotcles;
    }

    public function addIdmotcle(Motcles $idmotcle): static
    {
        if (!$this->idmotcles->contains($idmotcle)) {
            $this->idmotcles->add($idmotcle);
            $idmotcle->addMarquepage($this);
        }

        return $this;
    }

    public function removeIdmotcle(Motcles $idmotcle): static
    {
        if ($this->idmotcles->removeElement($idmotcle)) {
            $idmotcle->removeMarquepage($this);
        }

        return $this;
    }
}
