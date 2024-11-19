<?php

namespace App\Entity;

use App\Repository\RealisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealisationRepository::class)]
class Realisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_projet = null;

    #[ORM\Column]
    private ?int $numero_projet = null;

    // Relation OneToMany avec DetailsRealisation
    #[ORM\OneToMany(mappedBy: 'realisation', targetEntity: DetailsRealisation::class, cascade: ['persist', 'remove'])]
    private Collection $detailsRealisations;

    #[ORM\Column(length: 255)]
    private ?string $image_pricipale = null;

    public function __construct()
    {
        // Initialise la collection des détails de réalisation
        $this->detailsRealisations = new ArrayCollection();
    }

    // Ajout de la méthode addDetailsRealisation
    public function addDetailsRealisation(DetailsRealisation $detailsRealisation): self
    {
        if (!$this->detailsRealisations->contains($detailsRealisation)) {
            $this->detailsRealisations[] = $detailsRealisation;
            $detailsRealisation->setRealisation($this);
        }

        return $this;
    }

    // Ajout de la méthode removeDetailsRealisation
    public function removeDetailsRealisation(DetailsRealisation $detailsRealisation): self
    {
        if ($this->detailsRealisations->removeElement($detailsRealisation)) {
            // Si le détail de réalisation est supprimé, on retire la relation
            if ($detailsRealisation->getRealisation() === $this) {
                $detailsRealisation->setRealisation(null);
            }
        }

        return $this;
    }

    // Getters et setters pour d'autres propriétés
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProjet(): ?string
    {
        return $this->nom_projet;
    }

    public function setNomProjet(string $nom_projet): static
    {
        $this->nom_projet = $nom_projet;

        return $this;
    }

    public function getNumeroProjet(): ?int
    {
        return $this->numero_projet;
    }

    public function setNumeroProjet(int $numero_projet): static
    {
        $this->numero_projet = $numero_projet;

        return $this;
    }

    // Accéder à la collection de DetailsRealisation
    public function getDetailsRealisations(): Collection
    {
        return $this->detailsRealisations;
    }

    public function getImagePricipale(): ?string
    {
        return $this->image_pricipale;
    }

    public function setImagePricipale(string $image_pricipale): static
    {
        $this->image_pricipale = $image_pricipale;

        return $this;
    }
}
