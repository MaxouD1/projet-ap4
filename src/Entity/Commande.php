<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource()]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $etat = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseLiv = null;

    #[ORM\Column]
    private ?int $codePostal = null;

    #[ORM\Column(length: 100)]
    private ?string $villeLiv = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $fkUser = null;

    #[ORM\OneToMany(mappedBy: 'fkCommande', targetEntity: Contenir::class)]
    private Collection $contenirs;

    public function __construct()
    {
        $this->contenirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getAdresseLiv(): ?string
    {
        return $this->adresseLiv;
    }

    public function setAdresseLiv(string $adresseLiv): static
    {
        $this->adresseLiv = $adresseLiv;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVilleLiv(): ?string
    {
        return $this->villeLiv;
    }

    public function setVilleLiv(string $villeLiv): static
    {
        $this->villeLiv = $villeLiv;

        return $this;
    }

    public function getFkUserId(): ?User
    {
        return $this->fkUser;
    }

    public function setFkUserId(?User $fkUser): static
    {
        $this->fkUser = $fkUser;

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
            $contenir->setFkCommandeId($this);
        }

        return $this;
    }

    public function removeContenir(Contenir $contenir): static
    {
        if ($this->contenirs->removeElement($contenir)) {
            // set the owning side to null (unless already changed)
            if ($contenir->getFkCommandeId() === $this) {
                $contenir->setFkCommandeId(null);
            }
        }

        return $this;
    }
}