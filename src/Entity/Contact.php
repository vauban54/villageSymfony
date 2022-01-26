<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eMail;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToMany(targetEntity=Civilite::class, mappedBy="contacts")
     */
    private $civilites;

    /**
     * @ORM\ManyToOne(targetEntity=Motif::class, inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $motif;

    public function __construct()
    {
        $this->civilites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEMail(): ?string
    {
        return $this->eMail;
    }

    public function setEMail(string $eMail): self
    {
        $this->eMail = $eMail;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection|Civilite[]
     */
    public function getCivilites(): Collection
    {
        return $this->civilites;
    }

    public function addCivilite(Civilite $civilite): self
    {
        if (!$this->civilites->contains($civilite)) {
            $this->civilites[] = $civilite;
            $civilite->addContact($this);
        }

        return $this;
    }

    public function removeCivilite(Civilite $civilite): self
    {
        if ($this->civilites->removeElement($civilite)) {
            $civilite->removeContact($this);
        }

        return $this;
    }

    public function getMotif(): ?Motif
    {
        return $this->motif;
    }

    public function setMotif(?Motif $motif): self
    {
        $this->motif = $motif;

        return $this;
    }
}
