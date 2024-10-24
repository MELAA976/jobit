<?php

namespace App\Entity;

use App\Repository\PublicaOffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicaOffreRepository::class)]
class PublicaOffre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intituler = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePublication = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateModification = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $duree = null;

    #[ORM\ManyToOne(inversedBy: 'publicaOffres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * @var Collection<int, OffreUser>
     */
    #[ORM\OneToMany(targetEntity: OffreUser::class, mappedBy: 'offre')]
    private Collection $offreUsers;

    #[ORM\ManyToOne(inversedBy: 'publicaOffres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'publicaOffres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeContrat $typeContrat = null;

    public function __construct()
    {
        $this->offreUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntituler(): ?string
    {
        return $this->intituler;
    }

    public function setIntituler(string $intituler): static
    {
        $this->intituler = $intituler;

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

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): static
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->dateModification;
    }

    public function setDateModification(?\DateTimeInterface $dateModification): static
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, OffreUser>
     */
    public function getOffreUsers(): Collection
    {
        return $this->offreUsers;
    }

    public function addOffreUser(OffreUser $offreUser): static
    {
        if (!$this->offreUsers->contains($offreUser)) {
            $this->offreUsers->add($offreUser);
            $offreUser->setOffre($this);
        }

        return $this;
    }

    public function removeOffreUser(OffreUser $offreUser): static
    {
        if ($this->offreUsers->removeElement($offreUser)) {
            // set the owning side to null (unless already changed)
            if ($offreUser->getOffre() === $this) {
                $offreUser->setOffre(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getTypeContrat(): ?TypeContrat
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(?TypeContrat $typeContrat): static
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }
}
