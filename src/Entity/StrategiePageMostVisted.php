<?php

namespace App\Entity;

use App\Repository\StrategiePageMostVistedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StrategiePageMostVistedRepository::class)
 */
class StrategiePageMostVisted
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $article;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbVisite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timestamp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?int
    {
        return $this->article;
    }

    public function setArticle(int $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getNbVisite(): ?int
    {
        return $this->nbVisite;
    }

    public function setNbVisite(int $nbVisite): self
    {
        $this->nbVisite = $nbVisite;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }
}
