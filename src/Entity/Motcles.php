<?php

namespace App\Entity;

use App\Repository\MotclesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotclesRepository::class)]
class Motcles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Marquepages::class, inversedBy: 'idmotcles')]
    private Collection $marquepages;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $mc = null;

    public function __construct()
    {
        $this->marquepages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, marquepages>
     */
    public function getMarquepages(): Collection
    {
        return $this->marquepages;
    }

    public function addMarquepage(marquepages $marquepage): static
    {
        if (!$this->marquepages->contains($marquepage)) {
            $this->marquepages->add($marquepage);
        }

        return $this;
    }

    public function removeMarquepage(marquepages $marquepage): static
    {
        $this->marquepages->removeElement($marquepage);

        return $this;
    }

    public function getMc(): ?string
    {
        return $this->mc;
    }

    public function setMc(?string $mc): static
    {
        $this->mc = $mc;

        return $this;
    }
}
