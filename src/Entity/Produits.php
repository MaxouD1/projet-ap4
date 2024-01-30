<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
#[ApiResource()]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\Column(length: 10)]
    // private ?string $taille = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rayon $rayon = null;

    #[ORM\OneToMany(mappedBy: 'fkProduit', targetEntity: Stocker::class)]
    private Collection $stockers;

    #[ORM\OneToMany(mappedBy: 'fkProduit', targetEntity: Contenir::class)]
    private Collection $contenirs;

    #[ORM\OneToMany(mappedBy: 'fkProduit', targetEntity: Existe::class)]
    private Collection $existes;

    #[ORM\Column(length: 18, nullable: true)]
    private ?string $reference = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $image = null;


    public function __construct()
    {
        $this->stockers = new ArrayCollection();
        $this->contenirs = new ArrayCollection();
        $this->existes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    // public function getTaille(): ?string
    // {
    //     return $this->taille;
    // }

    // public function setTaille(string $taille): static
    // {
    //     $this->taille = $taille;

    //     return $this;
    // }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRayonId(): ?Rayon
    {
        return $this->rayon;
    }

    public function setRayonId(?Rayon $rayon): static
    {
        $this->rayon = $rayon;

        return $this;
    }

    /**
     * @return Collection<int, Stocker>
     */
    public function getStockers(): Collection
    {
        return $this->stockers;
    }

    public function addStocker(Stocker $stocker): static
    {
        if (!$this->stockers->contains($stocker)) {
            $this->stockers->add($stocker);
            $stocker->setFkProduitId($this);
        }

        return $this;
    }

    public function removeStocker(Stocker $stocker): static
    {
        if ($this->stockers->removeElement($stocker)) {
            // set the owning side to null (unless already changed)
            if ($stocker->getFkProduitId() === $this) {
                $stocker->setFkProduitId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contenir>
     */
    public function getContenirs(): Collection
    {
        return $this->contenirs;
    }

    public function addContenir(Contenir $contenir): static
    {
        if (!$this->contenirs->contains($contenir)) {
            $this->contenirs->add($contenir);
            $contenir->setFkProduitId($this);
        }

        return $this;
    }

    public function removeContenir(Contenir $contenir): static
    {
        if ($this->contenirs->removeElement($contenir)) {
            // set the owning side to null (unless already changed)
            if ($contenir->getFkProduitId() === $this) {
                $contenir->setFkProduitId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Existe>
     */
    public function getExistes(): Collection
    {
        return $this->existes;
    }

    public function addExiste(Existe $existe): static
    {
        if (!$this->existes->contains($existe)) {
            $this->existes->add($existe);
            $existe->setFkProduitId($this);
        }

        return $this;
    }

    public function removeExiste(Existe $existe): static
    {
        if ($this->existes->removeElement($existe)) {
            // set the owning side to null (unless already changed)
            if ($existe->getFkProduitId() === $this) {
                $existe->setFkProduitId(null);
            }
        }

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

}