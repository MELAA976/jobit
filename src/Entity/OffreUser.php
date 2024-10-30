<?php

namespace App\Entity;

use App\Repository\OffreUserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreUserRepository::class)]
class OffreUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCandidature = null;

    #[ORM\ManyToOne(inversedBy: 'offreUsers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PublicaOffre $offre = null;

    #[ORM\ManyToOne(inversedBy: 'offreUsers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCandidature(): ?\DateTimeInterface
    {
        return $this->dateCandidature;
    }

    public function setDateCandidature(\DateTimeInterface $dateCandidature): static
    {
        $this->dateCandidature = $dateCandidature;

        return $this;
    }

    public function getOffre(): ?PublicaOffre
    {
        return $this->offre;
    }

    public function setOffre(?PublicaOffre $offre): static
    {
        $this->offre = $offre;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
