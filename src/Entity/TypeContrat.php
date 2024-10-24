<?php

namespace App\Entity;

use App\Repository\TypeContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeContratRepository::class)]
class TypeContrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, PublicaOffre>
     */
    #[ORM\OneToMany(targetEntity: PublicaOffre::class, mappedBy: 'typeContrat')]
    private Collection $publicaOffres;

    public function __construct()
    {
        $this->publicaOffres = new ArrayCollection();
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

    /**
     * @return Collection<int, PublicaOffre>
     */
    public function getPublicaOffres(): Collection
    {
        return $this->publicaOffres;
    }

    public function addPublicaOffre(PublicaOffre $publicaOffre): static
    {
        if (!$this->publicaOffres->contains($publicaOffre)) {
            $this->publicaOffres->add($publicaOffre);
            $publicaOffre->setTypeContrat($this);
        }

        return $this;
    }

    public function removePublicaOffre(PublicaOffre $publicaOffre): static
    {
        if ($this->publicaOffres->removeElement($publicaOffre)) {
            // set the owning side to null (unless already changed)
            if ($publicaOffre->getTypeContrat() === $this) {
                $publicaOffre->setTypeContrat(null);
            }
        }

        return $this;
    }
}
