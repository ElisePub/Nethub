<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 1000)]
    private ?string $contenu = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(name: 'l_utilisateur_id', referencedColumnName: 'id', nullable: false)]
    private ?Utilisateur $lUtilisateur = null;

    #[ORM\Column(nullable: true)]
    private ?int $reponses = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getReponses(): ?int
    {
        return $this->reponses;
    }

    public function setReponses(?int $reponses): static
    {
        $this->reponses = $reponses;

        return $this;
    }

    public function getLUtilisateur(): ?Utilisateur
    {
        return $this->lUtilisateur;
    }

    public function setLUtilisateur(?Utilisateur $lUtilisateur): static
    {
        $this->lUtilisateur = $lUtilisateur;

        return $this;
    }
}
