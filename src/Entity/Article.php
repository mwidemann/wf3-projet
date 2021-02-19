<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $art_nom;

    /**
     * @ORM\Column(type="text")
     */
    private $descri;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\Column(type="float", scale=2)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cat1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cat2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cat3;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $top = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtNom(): ?string
    {
        return $this->art_nom;
    }

    public function setArtNom(string $art_nom): self
    {
        $this->art_nom = $art_nom;

        return $this;
    }

    public function getDescri(): ?string
    {
        return $this->descri;
    }

    public function setDescri(string $descri): self
    {
        $this->descri = $descri;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCat1(): ?string
    {
        return $this->cat1;
    }

    public function setCat1(string $cat1): self
    {
        $this->cat1 = $cat1;

        return $this;
    }

    public function getCat2(): ?string
    {
        return $this->cat2;
    }

    public function setCat2(?string $cat2): self
    {
        $this->cat2 = $cat2;

        return $this;
    }

    public function getCat3(): ?string
    {
        return $this->cat3;
    }

    public function setCat3(?string $cat3): self
    {
        $this->cat3 = $cat3;

        return $this;
    }

    public function getTop(): ?bool
    {
        return $this->top;
    }

    public function setTop(?bool $top): self
    {
        $this->top = $top;

        return $this;
    }
}
