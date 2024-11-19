<?php

namespace App\Entity;

use App\Repository\DetailsRealisationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailsRealisationRepository::class)]
class DetailsRealisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $chemin_image = null;

    #[ORM\ManyToOne(targetEntity: Realisation::class, inversedBy: 'detailsRealisations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Realisation $realisation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheminImage(): ?string
    {
        return $this->chemin_image;
    }

    public function setCheminImage(string $chemin_image): static
    {
        $this->chemin_image = $chemin_image;

        return $this;
    }

    public function getRealisation(): ?Realisation
    {
        return $this->realisation;
    }

    public function setRealisation(?Realisation $realisation): static
    {
        $this->realisation = $realisation;

        return $this;
    }
}
