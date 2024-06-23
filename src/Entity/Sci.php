<?php

namespace App\Entity;

use App\Repository\SciRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SciRepository::class)]
class Sci
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $idSci = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(length: 30)]
    private ?string $formeJuridique = null;

    #[ORM\Column]
    private ?bool $etablieEnFrance = null;

    #[ORM\Column]
    private ?bool $salarieEnFrance = null;

    #[ORM\Column(length: 255)]
    private ?string $denomination = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTimeInterface $dateImmat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?float $montantCapital = null;

    #[ORM\Column(length: 5)]
    private ?string $deviseCapital = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEffetFermeture = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $codeApe = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $fileName = null;

    #[ORM\Column(nullable: true)]
    private ?int $positionInJson = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $Id): static
    {
        $this->id = $Id;
        return $this;
    }

    public function getIdSCI(): ?string
    {
        return $this->idSci;
    }

    public function setIdSCI(string $idSCI): static
    {
        $this->idSci = $idSCI;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getFormeJuridique(): ?string
    {
        return $this->formeJuridique;
    }

    public function setFormeJuridique(string $formeJuridique): static
    {
        $this->formeJuridique = $formeJuridique;

        return $this;
    }

    public function isEtablieEnFrance(): ?bool
    {
        return $this->etablieEnFrance;
    }

    public function setEtablieEnFrance(bool $etablieEnFrance): static
    {
        $this->etablieEnFrance = $etablieEnFrance;

        return $this;
    }

    public function isSalarieEnFrance(): ?bool
    {
        return $this->salarieEnFrance;
    }

    public function setSalarieEnFrance(bool $salarieEnFrance): static
    {
        $this->salarieEnFrance = $salarieEnFrance;

        return $this;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): static
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getDateImmat(): ?\DateTimeInterface
    {
        return $this->dateImmat;
    }

    public function setDateImmat(\DateTimeInterface $dateImmat): static
    {
        $this->dateImmat = $dateImmat;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMontantCapital(): ?float
    {
        return $this->montantCapital;
    }

    public function setMontantCapital(?float $montantCapital): static
    {
        $this->montantCapital = $montantCapital;

        return $this;
    }

    public function getDeviseCapital(): ?string
    {
        return $this->deviseCapital;
    }

    public function setDeviseCapital(string $deviseCapital): static
    {
        $this->deviseCapital = $deviseCapital;

        return $this;
    }

    public function getDateEffetFermeture(): ?\DateTimeInterface
    {
        return $this->dateEffetFermeture;
    }

    public function setDateEffetFermeture(?\DateTimeInterface $dateEffetFermeture): static
    {
        $this->dateEffetFermeture = $dateEffetFermeture;

        return $this;
    }

    public function getCodeApe(): ?string
    {
        return $this->codeApe;
    }

    public function setCodeApe(?string $codeApe): static
    {
        $this->codeApe = $codeApe;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getPositionInJson(): ?int
    {
        return $this->positionInJson;
    }

    public function setPositionInJson(?int $positionInJson): static
    {
        $this->positionInJson = $positionInJson;

        return $this;
    }
}
